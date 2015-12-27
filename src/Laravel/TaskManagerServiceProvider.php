<?php

namespace Areyi\TaskManager\Laravel;

use Illuminate\Support\ServiceProvider;
use Areyi\TaskManager\config\taskmanager;
use Config;

class TaskManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->prepareResources();
    }
    
    /**
     * Prepare the package resources.
     *
     * @return void
     */
    protected function prepareResources()
    {
        
    }
}