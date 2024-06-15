<?php

declare(strict_types=1);

namespace Codeat3\BladeJamIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeJamIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-jam-icons', []);

            $factory->add('jam-icons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-jam-icons.php', 'blade-jam-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-jam-icons'),
            ], 'blade-jam-icons');

            $this->publishes([
                __DIR__ . '/../config/blade-jam-icons.php' => $this->app->configPath('blade-jam-icons.php'),
            ], 'blade-jam-icons-config');
        }
    }
}
