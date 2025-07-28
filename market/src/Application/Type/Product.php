<?php

declare(strict_types=1);

namespace Market\Application\Type;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

readonly class Product
{
    public function __construct(
        public UuidInterface $id,
        public string $title,
        public string $image,
        public Money $price,
    ) {}
}
