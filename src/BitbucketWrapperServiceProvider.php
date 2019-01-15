<?php

namespace BitbucketWrapper;

use Illuminate\Support\ServiceProvider;

class BitbucketWrapperServiceProvider extends ServiceProvider
{
    /**
     * @param none
     * @return none
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/bitbucket.php' => config_path('bitbucket.php'),
        ]);
    }
}
