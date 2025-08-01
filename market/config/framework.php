<?php

declare(strict_types=1);

use Duyler\Builder\Config\BuildConfig;
use Duyler\Builder\Config\PackagesConfig;
use Duyler\Config\ConfigInterface;
use Duyler\EventBus\BusConfig;
use Duyler\EventBus\Enum\Mode;

/**
 * @var ConfigInterface $config
 */
return [
    PackagesConfig::class => [
        'packages' => [
            \Duyler\Http\Loader::class,
            \Duyler\Web\Loader::class,
            \Duyler\Aspect\Loader::class,
            \Duyler\IO\Loader::class,
            \Duyler\ORM\Loader::class,
            \Duyler\Scenario\Loader::class,
        ],
    ],

    BuildConfig::class => [
        'buildPaths' => ['build'],
    ],

    BusConfig::class => [
        'mode' => Mode::Queue,
    ],
];
