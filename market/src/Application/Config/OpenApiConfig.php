<?php

declare(strict_types=1);

namespace Market\Application\Config;

readonly class OpenApiConfig
{
    public function __construct(
        public string $pathToOpenApiSpec,
        public string $pathToJsonForUI,
    ) {}
}
