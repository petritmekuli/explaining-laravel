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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        /**
         * This is an example to stop users from updating profile info more than
         * 3 times within a minute. This is done using throttle middleware and passing
         * in this case update_settings Rate limiter.
         * This is one way to stop too many request but you can't do a lot more here.
         * Like you could inside the controller actions, interacting directly with the
         * Rate Limiter. You can show things like attempts left, time to retry etc.
         * A great example is locking login attempts to five. If you try more than five
         * within a minute an error message will be shown, showing you that only five
         * attempts are allowed within a min. Also shows the remaining time.
         */
        RateLimiter::for('update_settings', function (Request $request) {
            return Limit::perMinute(3)->by(auth()->user()->id);
        });
        /**
         * How RateLimiter actually works is by caching two picies of information for a
         * specific key which should be unique for each user. So for example email address
         * petrit@example.com(key): number of attempts(value)
         * petrit@example.com:time(key) : now time in seconds(value)
         *
         * And RateLimiter reads and writes to this data and it also shows all the info
         * using functions like: tooManyRequest, attempts, availableIn, hit, resetAttempts
         * etc. You could use either of RateLimiter facade or RateLimiter directly.
         */
    }

}
