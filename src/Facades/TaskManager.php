<?php 

namespace Areyi\TaskManager\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Database\Schema\Blueprint;
use Schema;
use Illuminate\Database\Seeder;

class TaskManager extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'Areyi\TaskManager\Base';
    }
}