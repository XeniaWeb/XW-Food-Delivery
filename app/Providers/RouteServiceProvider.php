<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware([
                'web',
                'verified',
                'check_user_role:admin',
            ])
                ->as('admin.')
                ->prefix('/admin')
                ->group(base_path('routes/web_admin.php'));

            Route::middleware([
                'web',
                'verified',
                'check_user_role:vendor',
            ])
                ->as('vendor.')
                ->prefix('/vendor')
                ->group(base_path('routes/web_vendor.php'));

            Route::middleware([
                'web',
                'verified',
                'check_user_role:staff',
            ])
                ->as('staff.')
                ->prefix('/staff')
                ->group(base_path('routes/web_staff.php'));

            Route::middleware([
                'web',
                'verified',
                'check_user_role:customer',
            ])
                ->as('customer.')
                ->prefix('/customer')
                ->group(base_path('routes/web_customer.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
