<?php

namespace Anthony\Structure\Providers;

use Illuminate\Support\ServiceProvider;

class StructureServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../Config/structure.php' => config_path('structure.php')
        ]);
        $this->mergeConfigFrom(__DIR__ . '/../Config/structure.php', 'structure');
        $this->loadTranslationsFrom(__DIR__ . '/../Lang', 'structure');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('Anthony\Structure\Generator\Commands\CreateEntity');
        $this->commands('Anthony\Structure\Generator\Commands\CreateController');
        $this->commands('Anthony\Structure\Generator\Commands\CreateCriteria');
        $this->commands('Anthony\Structure\Generator\Commands\CreateFilter');
        $this->commands('Anthony\Structure\Generator\Commands\CreateModel');
        $this->commands('Anthony\Structure\Generator\Commands\CreateRepository');
        $this->commands('Anthony\Structure\Generator\Commands\CreateRequest');
        $this->commands('Anthony\Structure\Generator\Commands\CreateResponse');
        $this->commands('Anthony\Structure\Generator\Commands\CreateSeeder');
        $this->commands('Anthony\Structure\Generator\Commands\CreateService');
        $this->commands('Anthony\Structure\Generator\Commands\CreateProvider');
        $this->commands('Anthony\Structure\Generator\Commands\CreateBinding');
        $this->commands('Anthony\Structure\Generator\Commands\FillController');
        //end-binding
    }
}
