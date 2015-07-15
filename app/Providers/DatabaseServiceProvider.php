<?php
namespace App\Providers;

use Frogsystem\Legacy\Services\Config;
use Frogsystem\Metamorphosis\Contracts\ConfigInterface;
use Frogsystem\Metamorphosis\Providers\ServiceProvider;
use Frogsystem\Metamorphosis\WebApplication;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * @param WebApplication $app
     * @param Capsule $capusle
     */
    public function __construct(WebApplication $app, Capsule $capusle, ConfigInterface $config)
    {
        $this->app = $app;
        $this->capsule = $capusle;
        $this->config = $config;
    }
    /**
     * Registers entries with the container.
     */
    public function plugin()
    {
        // Add connection settings
        $this->capsule->addConnection($this->config->get('database.'.$this->config->get('database.connection')));
        $this->app['Illuminate\Database\ConnectionResolverInterface']
            = $this->capsule->getDatabaseManager();
    }
}