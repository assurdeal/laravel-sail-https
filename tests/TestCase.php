<?php

namespace Assurdeal\SailHttps\Tests;

use Assurdeal\SailHttps\SailHttpsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

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
        config()->set([
            'sail-https' => [
                'enabled' => true,
                'authorized_domains' => [
                    'example.test',
                ],
            ],
        ]);
    }
}
