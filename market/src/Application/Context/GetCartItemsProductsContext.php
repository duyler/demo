<?php

declare(strict_types=1);

namespace Market\Application\Context;

use Cycle\ORM\ORMInterface;
use Duyler\EventBus\Action\Context\ActionContext;
use Duyler\EventBus\Action\Context\CustomContextInterface;
use Illuminate\Support\Collection;
use Market\Application\Type\CartItem;
use Market\Domain\Entity\Product;
use Market\Domain\Repository\ProductRepositoryInterface;

class GetCartItemsProductsContext implements CustomContextInterface
{
    public function __construct(
        private ActionContext $actionContext,
    ) {}

    public function repository(): ProductRepositoryInterface
    {
        return $this->actionContext->call(
            fn(ORMInterface $orm) => $orm->getRepository(Product::class),
        );
    }

    /** @return Collection<CartItem> */
    public function argument(): Collection
    {
        return $this->actionContext->argument();
    }
}
