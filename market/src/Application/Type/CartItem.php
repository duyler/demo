<?php

declare(strict_types=1);

namespace Market\Application\Type;

use DateTimeInterface;
use Ramsey\Uuid\UuidInterface;
use Yiisoft\Hydrator\Attribute\Parameter\Data;

readonly class CartItem
{
    public function __construct(
        #[Data('id')]
        public UuidInterface $id,
        #[Data('product_id')]
        public UuidInterface $productId,
        #[Data('user_id')]
        public UuidInterface $userId,
        #[Data('cart_id')]
        public UuidInterface $cartId,
        public int $quantity,
        #[Data('added_at')]
        public DateTimeInterface $addedAt,
    ) {}
}
