<?php

namespace App\Providers;

use App\Models\Review;
use App\Models\Task;
use App\Observers\ReviewObserver;
use App\Observers\TaskObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Task::observe(TaskObserver::class);
        Review::observe(ReviewObserver::class);
    }
}
