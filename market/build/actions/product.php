<?php

declare(strict_types=1);

use Cycle\Database\Injection\Parameter;
use Duyler\Builder\Build\Action\Action;
use Duyler\Config\ConfigInterface;
use Duyler\EventBus\Build\Type;
use Illuminate\Support\Collection;
use Market\Application\Context\GetCartItemsProductsContext;
use Market\Application\Type\CartItem;
use Market\Domain\Action\Product;
use Market\Domain\Entity;

/**
 * @var ConfigInterface $config
 */

Action::declare(Product::GetCartItemsProducts)
    ->description('Get products for cart items')
    ->handler(function (GetCartItemsProductsContext $context) {
        return $context->argument()->whenNotEmpty(
            function (Collection $cartItems) use ($context) {
                $ids = $cartItems->keyBy('productId')->keys()->toArray();

                $products = $context
                    ->repository()
                    ->findAll(['id' => ['in' => new Parameter($ids)]]);

                return $products->map(function (Entity\Product $product) {
                    return new \Market\Application\Type\Product(
                        id: $product->getId(),
                        title: $product->getTitle(),
                        image: $product->getImage(),
                        price: $product->getPrice(),
                    );
                });
            },
            fn() => Collection::empty(),
        );
    })
    ->dependsOn(Type::collectionOf(CartItem::class))
    ->context(GetCartItemsProductsContext::class)
    ->type(\Market\Application\Type\Product::class, Collection::class)
    ->argument(CartItem::class, Collection::class);
