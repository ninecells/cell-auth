<?php

namespace NineCells\Member;

use App;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\AliasLoader;
use NineCells\Assets\Twbs3\Twbs3JumboNarrowServiceProvider;
use NineCells\Admin\PackageList;

class MemberServiceProvider extends ServiceProvider
{
    public function boot(MemberTab $tab, PackageList $packages)
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ncells');

        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $tab->addMemberTabItemInfo('profile', 'Profile', function($member_id) {
            return route('ncells::url.auth.member_profile', $member_id);
        });

        $packages->addPackageInfo('member', 'Members', function() {
            return 'AuthServiceProvider.php를 수정하세요';
        });
    }

    public function register()
    {
        App::register(SocialiteServiceProvider::class);
        AliasLoader::getInstance()->alias('Socialite', Socialite::class);

        App::register(Twbs3JumboNarrowServiceProvider::class);

        $this->app->singleton(MemberTab::class, function ($app) {
            return new MemberTab();
        });
    }
}
