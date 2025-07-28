<?php

declare(strict_types=1);

namespace Migrations;

use Cycle\Migrations\Migration;
use Override;

final class Version20250507231200 extends Migration
{
    protected const string DATABASE = 'default';

    #[Override]
    public function up(): void
    {
        $this
            ->table('cart')
            ->addColumn('id', 'string')
            ->addColumn('user_id', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->setPrimaryKeys(['id'])
            ->create();
    }

    #[Override]
    public function down(): void
    {
        $this->table('cart')->drop();
    }
}
