<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SlackServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('slack', static function () {
            return new \Maknz\Slack\Client(config('slack.webhook'), config('slack.settings'));
        });
    }
}
