<?php

declare(strict_types=1);

use Duyler\Config\ConfigInterface;
use Market\Application\Config\OpenApiConfig;

/**
 * @var ConfigInterface $config
 */
return [
    OpenApiConfig::class => [
        'pathToOpenApiSpec' => $config->path('docs/openapi.yaml'),
        'pathToJsonForUI' => $config->path('public/swagger/openapi.json'),
    ],
];
