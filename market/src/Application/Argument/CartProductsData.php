<?php

declare(strict_types=1);

namespace Market\Application\Argument;

use Illuminate\Support\Collection;
use Market\Application\Type\CartItem;
use Market\Application\Type\Product;

readonly class CartProductsData
{
    public function __construct(
        /** @var Collection<Product> */
        public Collection $products,
        /** @var Collection<CartItem> */
        public Collection $cartItems,
    ) {}
}
