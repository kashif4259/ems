<?php

namespace App\Providers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
           $data = DB::table('settings')->where('settingsid', '1')->first();

            $logo  = url('/').'/upload/'.$data->logo;
            $view->with('data', $data, $logo);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}