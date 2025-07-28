<?php

declare(strict_types=1);

namespace Market\Application\Type;

use Ramsey\Uuid\UuidInterface;

readonly class User
{
    public function __construct(
        public UuidInterface $id,
        public string $username,
        public string $email,
    ) {}
}
