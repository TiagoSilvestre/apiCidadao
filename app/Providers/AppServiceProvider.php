<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\IPersonCreation', 'App\Application\PersonCreation'
        );

        $this->app->bind(
            'App\Http\Interfaces\IPersonUpdate', 'App\Application\PersonUpdate'
        );     

        $this->app->bind(
            'App\Http\Interfaces\IPersonDelete', 'App\Application\PersonDelete'
        );        

        $this->app->bind(
            'App\Http\Interfaces\IPersonFind', 'App\Application\PersonFind'
        );    

        // Repositories    

        $this->app->bind(
            'App\Application\Interfaces\IPersistPersonRepository', 
            'App\Infrastructure\PersistenceViaEloquent\PersonRepository'
        );    

        $this->app->bind(
            'App\Application\Interfaces\IFindPersonById', 
            'App\Infrastructure\PersistenceViaEloquent\PersonRepository'
        );            

        $this->app->bind(
            'App\Application\Interfaces\IDeletePersonRepository', 
            'App\Infrastructure\PersistenceViaEloquent\PersonRepository'
        );  

        $this->app->singleton(\Faker\Generator::class, function () {
            return \Faker\Factory::create('pt_BR');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
