<?php

declare(strict_types=1);

namespace Migrations;

use Cycle\Migrations\Migration;
use Override;

final class Version20250507222906 extends Migration
{
    protected const string DATABASE = 'default';

    #[Override]
    public function up(): void
    {
        $this
            ->table('products')
            ->addColumn('id', 'string', ['nullable' => false, 'default' => null])
            ->addColumn('title', 'string', ['nullable' => false, 'default' => null])
            ->addColumn('image', 'string', ['length' => 255])
            ->addColumn('price', 'string', ['length' => 255])
            ->addColumn('currency', 'string', ['length' => 255])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->setPrimaryKeys(['id'])
            ->create();
    }

    #[Override]
    public function down(): void
    {
        $this->table('products')->drop();
    }
}
