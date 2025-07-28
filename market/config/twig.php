<?php

declare(strict_types=1);

use Duyler\Config\ConfigInterface;
use Duyler\TwigWrapper\TwigConfig;

/**
 * @var ConfigInterface $config
 */
return [
    TwigConfig::class => [
        'pathToViews' => $config->path('resources/views'),
        'extensions' => [

        ],
    ],
];
