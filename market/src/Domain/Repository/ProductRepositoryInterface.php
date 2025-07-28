<?php

declare(strict_types=1);

namespace Market\Domain\Repository;

use Illuminate\Support\Collection;
use Market\Domain\Entity\Product;

/**
 * @method Collection<Product> findAll(array $scope = [], array $orderBy = [])
 */
interface ProductRepositoryInterface {}
