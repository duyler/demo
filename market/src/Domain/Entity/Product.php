<?php

declare(strict_types=1);

namespace Market\Domain\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Product
{
    private UuidInterface $id;
    private string $title;
    private string $price;
    private string $currency;
    private string $image;
    private DateTimeInterface $createdAt;
    private DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->id = Uuid::uuid7();
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = $this->createdAt;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getPrice(): Money
    {
        return new Money($this->price, new Currency($this->currency));
    }

    public function setPrice(Money $price): self
    {
        $this->price = $price->getAmount();
        $this->currency = $price->getCurrency()->getCode();
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
