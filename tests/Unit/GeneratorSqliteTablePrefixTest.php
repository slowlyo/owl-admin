<?php

namespace Slowlyo\OwlAdmin\Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;
use Slowlyo\OwlAdmin\Tests\TestCase;

class GeneratorSqliteTablePrefixTest extends TestCase
{
    /**
     * 代码生成器在 SQLite + 表前缀下应能读到字段（PRAGMA 须用物理表名）。
     */
    protected function defineEnvironment($app): void
    {
        parent::defineEnvironment($app);

        $app['config']->set('admin.database.generator', ['testing']);
    }

    public function test_get_database_columns_reads_sqlite_table_with_connection_prefix(): void
    {
        Schema::connection('testing')->create('demo_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        $columns = (new Generator())->getDatabaseColumns();

        $databaseKey = ':memory:';

        $this->assertArrayHasKey('demo_posts', $columns->get($databaseKey, []));
        $this->assertTrue(
            collect($columns->get($databaseKey)['demo_posts'])->pluck('name')->contains('title')
        );
    }
}
