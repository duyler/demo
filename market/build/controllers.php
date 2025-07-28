<?php

declare(strict_types=1);

use Duyler\Config\ConfigInterface;
use Duyler\Router\Enum\Type;
use Duyler\Web\Build\Attribute\Route;
use Duyler\Web\Build\Controller;
use Duyler\Web\Enum\HttpMethod;
use Market\Application\Controller\GetCartController;
use Market\Domain\Action\Cart;
use Market\Domain\Action\Product;
use Market\Domain\Action\Sales;

/**
 * @var ConfigInterface $config
 */

Controller::build(GetCartController::class)
    ->actions(
        Cart::GetCart,
        Cart::GetCartId,
        Cart::GetCartProducts,
        Cart::GetCartItems,
        Product::GetCartItemsProducts,
        Sales::GetUserDiscount,
    )
    ->attributes(
        new Route(
            method: HttpMethod::Get,
            pattern: '/api/carts/{$cartId}',
            where: ['cartId' => Type::String],
        ),
    );
