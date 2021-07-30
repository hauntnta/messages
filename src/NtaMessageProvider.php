<?php

namespace DevNta\Messages;

use DevNta\Messages\Console\NtaGenerateMessage;
use Illuminate\Support\ServiceProvider;

class NtaMessageProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'nta_message');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'lang_core');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('nta_message.php')
            ], 'config');
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang')
            ], 'lang');
            $this->commands([
                NtaGenerateMessage::class
            ]);
        }
    }
}
