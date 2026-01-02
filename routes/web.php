<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [CarController::class, 'home'])->name('home');

// Liste des voitures disponibles + Recherche
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

// Détail d'une voiture (Note: utilise 'id' si ton contrôleur attend $id)
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');

// Voitures déjà vendues
Route::get('/sold-cars', [CarController::class, 'soldCars'])->name('cars.sold');

// FAQ
Route::get('/faq', function () {
    return view('frontend.faq');
})->name('faq');

// Contact
Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');
Route::post('/contact', function () {
    // TODO: Implémenter l'envoi d'email
    return redirect('/contact')->with('success', 'Votre message a été envoyé avec succès!');
});

// About
Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

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
| Routes admin (avec middleware 'auth' + 'admin')
|--------------------------------------------------------------------------
*/

// Dashboard admin
Route::middleware(['auth', 'admin'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Groupe admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des voitures
    Route::get('cars', [CarController::class, 'adminIndex'])->name('cars.index');
    Route::get('cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('cars/{id}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
    
    // Gestion des images de voiture
    Route::delete('cars/images/{id}', [CarController::class, 'deleteImage'])->name('cars.deleteImage');
    
    // IMPORTANT : Cette route doit rester en POST pour éviter l'erreur 405
    Route::post('cars/{id}/mark-sold', [CarController::class, 'markSold'])->name('cars.markSold');

    // Gestion des ventes
    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    // Optionnel : Route pour annuler une vente si erreur
    Route::delete('sales/{id}', [SaleController::class, 'destroy'])->name('sales.destroy');

    // Archivage automatique
    Route::get('archive-cars', [CarController::class, 'archiveOldCars'])->name('cars.archive');
});