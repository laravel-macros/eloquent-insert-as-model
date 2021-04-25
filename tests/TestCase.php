<?php

namespace LaravelMacros\Eloquent\Tests;

use Illuminate\Database\Schema\Blueprint;
use LaravelMacros\Eloquent\InsertAsModelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase();
    }

    protected function getPackageProviders($app)
    {
        return [
            InsertAsModelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function setUpDatabase()
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->json('options')->default('[]');
            $table->json('shelf')->default('{}');
            $table->string('username')->nullable();
            $table->timestamps();
        });
    }
}
