<?php

namespace Nox0121\EloquentVolumeable\Test;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [

        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUpDatabase()
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('dummies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('volume_column')->nullable();
        });

        $this->app['db']->connection()->getSchemaBuilder()->create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
        });

        collect(range(1, 3))->each(function (int $i) {
            Dummy::create(['name' => $i]);
        });

        collect(range(1, 5))->each(function (int $i) {
            Attachment::create(['description' => $i]);
        });
    }
}
