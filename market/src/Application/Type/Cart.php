<?php

declare(strict_types=1);

namespace Market\Application\Type;

use Illuminate\Support\Collection;
use Money\Money;

readonly class Cart
{
    public Money $total;
    public Money $totalWithDiscount;
    public Money $totalDiscount;
    public int $totalQuantity;

    public function __construct(
        /** @var Collection<CartProduct> */
        public Collection $products,
        public Discount $discount,
    ) {
        $total = Money::USD(0);
        $totalQuantity = 0;

        foreach ($this->products as $cartProduct) {
            $productPrice = $cartProduct->price->multiply($cartProduct->quantity);
            $total = $total->add($productPrice);
            $totalQuantity += $cartProduct->quantity;
        }

        $totalDiscount = ($total->divide(100))->multiply($this->discount->percentage);

        $this->total = $total;
        $this->totalQuantity = $totalQuantity;
        $this->totalDiscount = $totalDiscount;
        $this->totalWithDiscount = $total->subtract($totalDiscount);
    }
}
