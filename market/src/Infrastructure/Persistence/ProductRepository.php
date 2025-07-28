<?php

declare(strict_types=1);

namespace Market\Infrastructure\Persistence;

use Cycle\ORM\Select\Repository;
use Market\Domain\Repository\ProductRepositoryInterface;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    public function findAll(array $scope = [], array $orderBy = []): iterable
    {
        return collect(parent::findAll($scope, $orderBy));
    }
}
