<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Offre;
use App\Models\Entreprise;
use App\Models\Candidat;
use App\Observers\OffreObserver;
use App\Observers\EntrepriseObserver;
use App\Observers\CandidatObserver;

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
        Offre::observe(OffreObserver::class);
        Entreprise::observe(EntrepriseObserver::class);
        Candidat::observe(CandidatObserver::class);
    }
}