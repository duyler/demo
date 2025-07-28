<?php

declare(strict_types=1);

use Duyler\Aspect\Build\Attribute\Before;
use Duyler\Builder\Build\Action\Action;
use Duyler\Config\ConfigInterface;
use Duyler\Web\Build\Attribute\Route;
use Duyler\Web\Build\Attribute\View;
use Duyler\Web\Enum\HttpMethod;
use Market\Application\Aspect\DeniedForProdEnv;

/**
 * @var ConfigInterface $config
 */

Action::declare()
    ->description('Show home page')
    ->attributes(
        new Route(
            method: HttpMethod::Get,
            pattern: '/',
        ),
        new View(
            name: 'home',
        ),
    );

Action::declare()
    ->description('View cart items')
    ->attributes(
        new Route(
            method: HttpMethod::Get,
            pattern: '/cart',
        ),
        new View(
            name: 'cart',
        ),
    );

Action::declare()
    ->description('Render Swagger UI')
    ->attributes(
        new Route(
            method: HttpMethod::Get,
            pattern: '/swagger',
        ),
        new View(
            name: 'swagger',
        ),
        new Before(
            DeniedForProdEnv::class,
        ),
    );
