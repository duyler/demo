<?php

declare(strict_types=1);

use Cycle\ORM\Parser\Typecast;
use Duyler\ORM\Build\Entity;
use Duyler\ORM\Typecast\UuidTypecast;
use Market\Domain\Entity\Cart;
use Market\Domain\Entity\CartItem;
use Market\Domain\Entity\Discount;
use Market\Domain\Entity\Product;
use Market\Domain\Entity\User;
use Market\Infrastructure\Persistence\ProductRepository;

Entity::declare(User::class)
    ->database('default')
    ->table('users')
    ->primaryKey('id')
    ->columns([
        'id' => 'id',
        'username' => 'username',
        'email' => 'email',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ])
    ->typecast([
        'id' => 'uuid',
        'username' => 'string',
        'email' => 'string',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ])
    ->typecastHandler([
        Typecast::class,
        UuidTypecast::class,
    ]);

Entity::declare(Cart::class)
    ->database('default')
    ->table('cart')
    ->primaryKey('id')
    ->columns([
        'id' => 'id',
        'userId' => 'user_id',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ])
    ->typecast([
        'id' => 'uuid',
        'userId' => 'uuid',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ])
    ->typecastHandler([
        Typecast::class,
        UuidTypecast::class,
    ]);

Entity::declare(CartItem::class)
    ->database('default')
    ->table('cart_items')
    ->primaryKey('id')
    ->columns([
        'id' => 'id',
        'productId' => 'product_id',
        'userId' => 'user_id',
        'cartId' => 'cart_id',
        'quantity' => 'quantity',
        'addedAt' => 'added_at',
    ])
    ->typecast([
        'id' => 'uuid',
        'productId' => 'uuid',
        'userId' => 'uuid',
        'cartId' => 'uuid',
        'quantity' => 'integer',
        'addedAt' => 'datetime',
    ])
    ->typecastHandler([
        Typecast::class,
        UuidTypecast::class,
    ]);

Entity::declare(Discount::class)
    ->database('default')
    ->table('discount')
    ->primaryKey('id')
    ->columns([
        'id' => 'id',
        'userId' => 'user_id',
        'percentage' => 'percentage',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ])
    ->typecast([
        'id' => 'uuid',
        'userId' => 'uuid',
        'percentage' => 'integer',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ])
    ->typecastHandler([
        Typecast::class,
        UuidTypecast::class,
    ]);

Entity::declare(Product::class)
    ->database('default')
    ->table('products')
    ->primaryKey('id')
    ->repository(ProductRepository::class)
    ->columns([
        'id' => 'id',
        'title' => 'title',
        'price' => 'price',
        'currency' => 'currency',
        'image' => 'image',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ])
    ->typecast([
        'id' => 'uuid',
        'title' => 'string',
        'price' => 'integer',
        'currency' => 'string',
        'image' => 'image',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ])
    ->typecastHandler([
        Typecast::class,
        UuidTypecast::class,
    ]);
