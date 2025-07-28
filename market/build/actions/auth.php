<?php

declare(strict_types=1);

use Duyler\Builder\Build\Action\Action;
use Duyler\Config\ConfigInterface;
use Duyler\EventBus\Action\Context\ActionContext;
use Duyler\Web\Build\Attribute\Route;
use Duyler\Web\Enum\HttpMethod;
use Market\Application\Config\AuthConfig;
use Market\Application\Type\AuthData;
use Market\Domain\Action\Auth;

/**
 * @var ConfigInterface $config
 */

Action::declare(Auth::GetAuthData)
    ->description('Get auth data')
    ->handler(function (ActionContext $context) {
        return $context->call(fn(AuthConfig $authConfig) => new AuthData($authConfig->defaultUserId));
    })
    ->type(AuthData::class)
    ->config([
        AuthConfig::class => [
            'defaultUserId' => '0196ec04-9e4e-714f-b36f-8efed52183d7',
        ],
    ])
    ->attributes(
        new Route(
            method: HttpMethod::Get,
            pattern: '/api/auth',
        ),
    );
