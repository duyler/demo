<?php

declare(strict_types=1);

use Duyler\Builder\Build\Action\Action;
use Duyler\Config\ConfigInterface;
use Duyler\EventBus\Action\Context\ActionContext;
use Duyler\IO\DB;
use Market\Application\Type\AuthData;
use Market\Domain\Action\Sales;

/**
 * @var ConfigInterface $config
 */

Action::declare(Sales::GetUserDiscount)
    ->description('Get discount for user')
    ->handler(function (ActionContext $context) {
        /** @var AuthData $authData */
        $authData = $context->argument();

        return DB::connection()
            ->query('SELECT * FROM discount WHERE user_id = :user_id')
            ->setParams(['user_id' => $authData->userId->toString()])
            ->fetch(\Market\Application\Type\Discount::class)
            ->await();
    })
    ->require(\Market\Domain\Action\Auth::GetAuthData)
    ->type(\Market\Application\Type\Discount::class)
    ->argument(\Market\Application\Type\AuthData::class);
