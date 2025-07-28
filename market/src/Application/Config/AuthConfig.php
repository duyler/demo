<?php

declare(strict_types=1);

namespace Market\Application\Config;

readonly class AuthConfig
{
    public function __construct(
        public string $defaultUserId,
    ) {}
}
