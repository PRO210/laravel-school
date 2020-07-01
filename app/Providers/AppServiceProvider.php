<?php

namespace App\Providers;

use \App\Models\{
    Aluno,
    Plan,
    Tenant,
};
use \App\Observers\{
    AlunoObserver,
    PlanObserver,
    TenantObserver,
};
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Aluno::observe(AlunoObserver::class);


        Blade::if('admin', function () {

            $user = auth()->user();

            return $user->isAdmin();

        });

    }
}
