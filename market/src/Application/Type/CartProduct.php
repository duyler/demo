<?php

declare(strict_types=1);

namespace Market\Application\Type;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

readonly class CartProduct
{
    public function __construct(
        public UuidInterface $productId,
        public string $image,
        public string $title,
        public int $quantity,
        public Money $price,
    ) {}
}
