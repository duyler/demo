<?php

declare(strict_types=1);

use Duyler\Builder\Build\Action\Action;
use Duyler\Config\ConfigInterface;
use Duyler\EventBus\Action\Context\ActionContext;
use Duyler\EventBus\Action\Context\FactoryContext;
use Duyler\EventBus\Build\Type;
use Duyler\EventBus\Event\EventDispatcher;
use Duyler\Http\Action\Request;
use Duyler\Http\Event\Response;
use Duyler\IO\DB;
use HttpSoft\Response\JsonResponse;
use Illuminate\Support\Collection;
use Market\Application\Argument\CartData;
use Market\Application\Argument\CartProductsData;
use Market\Application\Type\CartId;
use Market\Application\Type\CartItem;
use Market\Application\Type\CartProduct;
use Market\Application\Type\Discount;
use Market\Application\Type\Product;
use Market\Domain\Action\Cart;
use Market\Domain\Action\Sales;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid;

/**
 * @var ConfigInterface $config
 */

Action::declare(Cart::GetCart)
    ->description('Get cart with full data')
    ->handler(function (ActionContext $context) {
        /** @var CartData $cartData */
        $cartData = $context->argument();

        return new \Market\Application\Type\Cart(
            products: $cartData->cartProducts,
            discount: $cartData->discount,
        );
    })
    ->argument(\Market\Application\Argument\CartData::class)
    ->type(\Market\Application\Type\Cart::class)
    ->dependsOn(
        Type::collectionOf(CartProduct::class),
        Type::of(Discount::class),
    )
    ->argumentFactory(fn(FactoryContext $context) => new CartData(
        cartProducts: $context->getTypeById(Cart::GetCartProducts),
        discount: $context->getTypeById(Sales::GetUserDiscount),
    ));

Action::declare(Cart::GetCartProducts)
    ->description('Fill cart items from products data')
    ->handler(
        function (ActionContext $context) {
            /** @var CartProductsData $cartProductsData */
            $cartProductsData = $context->argument();

            return $cartProductsData->cartItems->map(
                function (CartItem $cartItem) use ($cartProductsData) {
                    $product = $cartProductsData->products
                        ->keyBy('id')
                        ->get($cartItem->productId->toString());

                    return new CartProduct(
                        productId: $product->id,
                        image: $product->image,
                        title: $product->title,
                        quantity: $cartItem->quantity,
                        price: $product->price,
                    );
                },
            );
        },
    )
    ->dependsOn(
        Type::collectionOf(CartItem::class),
        Type::collectionOf(Product::class),
    )
    ->type(CartProduct::class, Collection::class)
    ->argument(CartProductsData::class)
    ->argumentFactory(fn(FactoryContext $context) => new CartProductsData(
        products: $context->getTypeCollection(Product::class),
        cartItems: $context->getTypeCollection(CartItem::class),
    ));

Action::declare(Cart::GetCartItems)
    ->description('Get items from cart')
    ->handler(function (ActionContext $context): Collection {
        /** @var CartId $cartId */
        $cartId = $context->argument();

        return DB::connection()
            ->query('SELECT * FROM cart_items WHERE cart_id = :cart_id')
            ->setParams(['cart_id' => $cartId->id->toString()])
            ->fetchAll(CartItem::class)
            ->await();
    })
    ->type(CartItem::class, Collection::class)
    ->dependsOn(Type::of(CartId::class))
    ->argument(CartId::class);

Action::declare(Cart::GetCartId)
    ->description('Get cart id from request')
    ->handler(function (ActionContext $context): CartId {
        /** @var ServerRequestInterface $request */
        $request = $context->argument();
        $cartId = Uuid::fromString($request->getAttribute('cartId'));
        return new CartId($cartId);
    })
    ->type(CartId::class)
    ->require(Request::GetRequest)
    ->argument(ServerRequestInterface::class);

Action::declare(Cart::SendCartResponse)
    ->description('Send cart response')
    ->handler(function (ActionContext $context) {
        EventDispatcher::dispatch(
            new \Duyler\EventBus\Dto\Event(
                id: Response::ResponseCreated,
                data: new JsonResponse($context->argument()),
            ),
        );
    })
    ->argument(\Market\Application\Type\Cart::class)
    ->dependsOn(Type::of(\Market\Application\Type\Cart::class));
