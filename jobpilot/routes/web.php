<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// PAGE D’ACCUEIL
Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD — accessible à tous les rôles connectés
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Suppression d’une offre depuis le dashboard (Admin ou Entreprise)
Route::delete('/dashboard/offre/{id}', [DashboardController::class, 'deleteOffre'])
    ->middleware(['auth', 'isAdminOrEntreprise', 'throttle:10,1'])
    ->name('dashboard.deleteOffre');

// PROFIL (tous les utilisateurs connectés)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/entreprises/{entreprise}', [EntrepriseController::class, 'show'])->name('entreprises.show');
    Route::get('/entreprises', [EntrepriseController::class, 'index'])->name('entreprises.index');

    Route::post('/candidats', [CandidatController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('candidats.store');

    Route::delete('/candidats/{candidat}', [CandidatController::class, 'destroy'])
        ->middleware('throttle:10,1')
        ->name('candidats.destroy');
});

// 🛠 ADMIN — gestion complète
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // CRUD entreprises
    Route::get('/entreprises/create', [EntrepriseController::class, 'create'])
        ->middleware('throttle:10,1')
        ->name('entreprises.create');

    Route::post('/entreprises', [EntrepriseController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('entreprises.store');

    Route::get('/entreprises/{entreprise}/edit', [EntrepriseController::class, 'edit'])
        ->middleware('throttle:10,1')
        ->name('entreprises.edit');

    Route::put('/entreprises/{entreprise}', [EntrepriseController::class, 'update'])
        ->middleware('throttle:10,1')
        ->name('entreprises.update');

    Route::delete('/entreprises/{entreprise}', [EntrepriseController::class, 'destroy'])
        ->middleware('throttle:10,1')
        ->name('entreprises.destroy');

    // CRUD candidats
    Route::get('/candidats/create', [CandidatController::class, 'create'])
        ->middleware('throttle:10,1')
        ->name('candidats.create');

    Route::get('/candidats/{candidat}/edit', [CandidatController::class, 'edit'])
        ->middleware('throttle:10,1')
        ->name('candidats.edit');

    Route::put('/candidats/{candidat}', [CandidatController::class, 'update'])
        ->middleware('throttle:10,1')
        ->name('candidats.update');

    // Gestion utilisateurs depuis dashboard
    Route::patch('/dashboard/user/{id}/role', [DashboardController::class, 'updateRole'])
        ->middleware('throttle:10,1')
        ->name('admin.updateRole');

    Route::delete('/dashboard/user/{id}', [DashboardController::class, 'deleteUser'])
        ->middleware('throttle:10,1')
        ->name('admin.deleteUser');
});

// 🏢 ENTREPRISE — gestion des offres
Route::middleware(['auth', 'isAdminOrEntreprise'])->group(function () {
    Route::get('/offres/create', [OffreController::class, 'create'])
        ->middleware('throttle:10,1')
        ->name('offres.create');

    Route::post('/offres', [OffreController::class, 'store'])
        ->middleware('throttle:10,1')
        ->name('offres.store');

    Route::get('/offres/{offre}/edit', [OffreController::class, 'edit'])
        ->middleware('throttle:10,1')
        ->name('offres.edit');

    Route::put('/offres/{offre}', [OffreController::class, 'update'])
        ->middleware('throttle:10,1')
        ->name('offres.update');

    Route::delete('/offres/{offre}', [OffreController::class, 'destroy'])
        ->middleware('throttle:10,1')
        ->name('offres.destroy');

    // Consultation candidats
    Route::get('/candidats', [CandidatController::class, 'index'])->name('candidats.index');
    Route::get('/candidats/{candidat}', [CandidatController::class, 'show'])->name('candidats.show');

    // Édition entreprise
    Route::get('/entreprises/{entreprise}/edit', [EntrepriseController::class, 'edit'])
        ->middleware('throttle:10,1')
        ->name('entreprises.edit');

    Route::put('/entreprises/{entreprise}', [EntrepriseController::class, 'update'])
        ->middleware('throttle:10,1')
        ->name('entreprises.update');
});

// 📢 OFFRES — visibles par tout utilisateur connecté
Route::middleware(['auth'])->group(function () {
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
    Route::get('/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');
});

require __DIR__.'/auth.php';
