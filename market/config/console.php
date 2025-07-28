<?php

declare(strict_types=1);

use Duyler\Config\ConfigInterface;
use Duyler\Console\CommandConfig;
use Market\Application\Action\OpenAPI;

/**
 * @var ConfigInterface $config
 */
return [
    CommandConfig::class => [
        'commands' => [
            'openapi:ui:generate' => OpenAPI::GenerateUI,
        ],
    ],
];
