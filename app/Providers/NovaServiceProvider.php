<?php

namespace App\Providers;

use App\Http\Controllers\SocialLoginController;
use App\Nova\Dashboards\PostsDashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Otwell\SidebarTool\SidebarTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::style('admin', public_path('css/admin.css'));

    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
        Route::domain(config('nova.domain', null))
        ->middleware(['web'])
        ->as('nova.')
        ->prefix(Nova::path())
        ->group(function () {
            Route::get('/login', 'Laravel\Nova\Http\Controllers\LoginController@showLoginForm');
            Route::get('/login/google', SocialLoginController::class . '@redirectToGoogle')
                ->name('login.google');
            Route::get('/google/callback', SocialLoginController::class . '@processGoogleCallback')
                ->name('login.callback');
        });

        Route::namespace('Laravel\Nova\Http\Controllers')
            ->domain(config('nova.domain', null))
            ->middleware(config('nova.middleware', []))
            ->as('nova.')
            ->prefix(Nova::path())
            ->group(function () {
                Route::get('/logout', 'LoginController@logout')->name('logout');
            });
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new PostsDashboard,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            (new SidebarTool)->canSee(function ($request) {
                return ! $request->user()->isBlockedFrom('sidebarTool');
            }),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
