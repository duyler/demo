<?php

declare(strict_types=1);

use Duyler\Builder\Build\State\StateContext;
use Duyler\Builder\Build\State\StateHandler;
use Duyler\Config\ConfigInterface;
use Market\Application\StateHandler\RequestValidationStateHandler;
use Market\Application\StateHandler\ResponseValidationStateHandler;

/**
 * @var ConfigInterface $config
 */

StateHandler::add(RequestValidationStateHandler::class);
StateHandler::add(ResponseValidationStateHandler::class);

StateContext::add([
    RequestValidationStateHandler::class,
    ResponseValidationStateHandler::class,
]);
