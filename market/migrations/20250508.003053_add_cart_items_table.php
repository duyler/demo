<?php

declare(strict_types=1);

namespace Migrations;

use Cycle\Migrations\Migration;
use Override;

final class Version20250508003053 extends Migration
{
    protected const string DATABASE = 'default';

    #[Override]
    public function up(): void
    {
        $this
            ->table('cart_items')
            ->addColumn('id', 'string')
            ->addColumn('user_id', 'string')
            ->addColumn('cart_id', 'string')
            ->addColumn('product_id', 'string')
            ->addColumn('quantity', 'integer')
            ->addColumn('added_at', 'datetime')
            ->setPrimaryKeys(['id'])
            ->create();

    }

    #[Override]
    public function down(): void
    {
        $this->table('cart_items')->drop();
    }
}
