<?php

declare(strict_types=1);

namespace Market\Application\Type;

readonly class Discount
{
    public function __construct(
        public int $percentage,
    ) {}

    public static function fromEntity(\Market\Domain\Entity\Discount $entity): Discount
    {
        return new self($entity->getPercentage());
    }
}
