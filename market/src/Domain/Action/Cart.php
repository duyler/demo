<?php

namespace Market\Domain\Action;

enum Cart
{
    case GetCart;
    case GetCartItems;
    case GetCartProducts;
    case GetCartId;
    case SendCartResponse;
}
