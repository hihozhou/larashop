<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        //

        $factory->macro('apiJson', function ($errorCode,$errorMsg,$data) use ($factory) {
            return $factory->json(
                [
                    'error_code'=>$errorCode,
                    'error_msg'=>$errorMsg,
                    'data'=>$data,
                ],
                200,
                ['Content-type'=>'application/json; charset=UTF-8']
            );
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
