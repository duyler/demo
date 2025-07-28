<?php

declare(strict_types=1);

namespace Market\Application\Argument;

use Illuminate\Support\Collection;
use Market\Application\Type\CartProduct;
use Market\Application\Type\Discount;

readonly class CartData
{
    public function __construct(
        /** @var Collection<string, CartProduct $cartProducts> */
        public Collection $cartProducts,
        public Discount $discount,
    ) {}
}
