<?php

declare(strict_types=1);

namespace Migrations;

use Cycle\Migrations\Migration;
use Override;

final class Version20250507224731 extends Migration
{
    protected const string DATABASE = 'default';

    #[Override]
    public function up(): void
    {
        $this
            ->table('users')
            ->addColumn('id', 'string')
            ->addColumn('username', 'string', ['length' => 255])
            ->addColumn('email', 'string', ['length' => 255])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->setPrimaryKeys(['id'])
            ->create();
    }

    #[Override]
    public function down(): void
    {
        $this->table('users')->drop();
    }
}
