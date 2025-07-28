<?php

declare(strict_types=1);

namespace Market\Application\Controller;

use Duyler\Web\Controller\BaseController;
use Market\Application\Type\Cart;
use Psr\Http\Message\ResponseInterface;

final class GetCartController extends BaseController
{
    public function __invoke(Cart $cart): ResponseInterface
    {
        return $this->json($cart);
    }
}
