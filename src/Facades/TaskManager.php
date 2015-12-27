<?php 

namespace Areyi\TaskManager\Facades;

use Illuminate\Support\Facades\Facade;

class TaskManager extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'Areyi\TaskManager\Base';
    }
}