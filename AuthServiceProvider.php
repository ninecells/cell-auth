<?php

namespace NineCells\Auth;

use App;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\AliasLoader;
use NineCells\Assets\Twbs3\Twbs3JumboNarrowServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ncells');

        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    public function register()
    {
        App::register(SocialiteServiceProvider::class);
        AliasLoader::getInstance()->alias('Socialite', Socialite::class);

        App::register(Twbs3JumboNarrowServiceProvider::class);
    }
}
