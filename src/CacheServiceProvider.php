<?php

namespace theopeneyes\caches;

use Illuminate\Support\ServiceProvider;


class CacheServiceProvider extends ServiceProvider{

    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/');
    }
    public function register()
    {
        
    }
}   