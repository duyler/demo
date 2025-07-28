<?php

declare(strict_types=1);

namespace Market\Domain\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CartItem
{
    private UuidInterface $id;
    private UuidInterface $productId;
    private UuidInterface $userId;
    private UuidInterface $cartId;
    private int $quantity;
    private DateTimeInterface $addedAt;

    public function __construct()
    {
        $this->id ??= Uuid::uuid7();
        $this->addedAt ??= new DateTimeImmutable();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getProductId(): UuidInterface
    {
        return $this->productId;
    }

    public function setProductId(UuidInterface $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getUserId(): UuidInterface
    {
        return $this->userId;
    }

    public function setUserId(UuidInterface $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getCartId(): UuidInterface
    {
        return $this->cartId;
    }

    public function setCartId(UuidInterface $cartId): self
    {
        $this->cartId = $cartId;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getAddedAt(): DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(DateTimeImmutable $addedAt): self
    {
        $this->addedAt = $addedAt;
    }
}
