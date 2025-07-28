<?php

declare(strict_types=1);

use Duyler\Builder\Build\Action\Action;
use Duyler\Config\ConfigInterface;
use Duyler\EventBus\Action\Context\ActionContext;
use Duyler\Http\Exception\NotFoundHttpException;
use Market\Application\Type\AuthData;
use Market\Domain\Action\User;

/**
 * @var ConfigInterface $config
 */

Action::declare(User::GetUser)
    ->description('Get user')
    ->handler(function (ActionContext $context) {

        /** @var AuthData $authData */
        $authData = $context->argument();

        /** @var \Market\Application\Type\User $user */
        $user = \Duyler\IO\DB::connection()
            ->query('SELECT * FROM users WHERE id = :id')
            ->setParams([':id' => $authData->userId->toString()])
            ->fetch(\Market\Application\Type\User::class)
            ->await();

        if (null === $user) {
            throw new NotFoundHttpException();
        }

        return $user;
    })
    ->type(\Market\Application\Type\User::class)
    ->require(\Market\Domain\Action\Auth::GetAuthData)
    ->argument(AuthData::class);
