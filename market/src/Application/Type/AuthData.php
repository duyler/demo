<?php

declare(strict_types=1);

namespace Market\Application\Type;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class AuthData
{
    public UuidInterface $userId;

    public function __construct(
        string $userId,
    ) {
        $this->userId = Uuid::fromString($userId);
    }
}
