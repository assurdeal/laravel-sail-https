<?php

namespace Assurdeal\SailHttps\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Assurdeal\SailHttps\SailHttpsServiceProvider;

class TestCase extends Orchestra
{
    /**
     * Get package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            SailHttpsServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     */
    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

    }
}
