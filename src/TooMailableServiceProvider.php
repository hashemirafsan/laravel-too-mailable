<?php

namespace Hashemi\TooMailable;

use Illuminate\Support\ServiceProvider;

class TooMailableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->setupConfig();
    }

    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/too-mailable.php');
        $this->publishes([$source => config_path('too-mailable.php')]);
        $this->mergeConfigFrom($source, 'too-mailable');
    }
}
