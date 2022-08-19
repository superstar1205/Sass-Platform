<?php

namespace Tests\Models;

use App\Models\Installer;
use Tests\TestCase;

class InstallerTest extends TestCase
{
    public Installer $installer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->installer = $this->app->get(Installer::class);
    }


    public function test_it_can_test_env_file()
    {
        $this->assertTrue($this->installer->envFileExists());
        $this->assertFalse($this->installer->envFileExists('.wrong-name'));
    }

    public function test_it_can_test_db_connection()
    {
        $this->assertTrue(
            $this->installer->databaseCanConnect(
                config('database.connections.mysql.host'),
                config('database.connections.mysql.port'),
                config('database.connections.mysql.database'),
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password'),
            )
        );

        $this->assertFalse(
            $this->installer->databaseCanConnect(
                config('database.connections.mysql.host'),
                config('database.connections.mysql.port'),
                'invalid-database',
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password'),
            )
        );
    }

}
