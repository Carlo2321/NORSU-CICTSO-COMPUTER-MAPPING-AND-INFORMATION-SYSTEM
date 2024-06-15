<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Extending the Activity model to add the causer relationship
        Activity::resolveRelationUsing('causer', function ($activityModel) {
            return $activityModel->belongsTo(User::class, 'causer_id');
        });
    }
}
