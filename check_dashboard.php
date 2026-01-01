<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Car;
use App\Models\Sale;

echo "=== STATISTIQUES ===\n";
echo "Total Voitures: " . Car::count() . "\n";
echo "Voitures Disponibles: " . Car::where('is_sold', false)->count() . "\n";
echo "Voitures Vendues: " . Car::where('is_sold', true)->count() . "\n";
echo "Total Ventes (entrées): " . Sale::count() . "\n";
echo "Chiffre d'affaires: " . Sale::sum('prix_vente') . " €\n";
echo "\n";

echo "=== VENTES RÉCENTES ===\n";
$sales = Sale::latest()->take(5)->get();
foreach ($sales as $sale) {
    echo $sale->client_nom . " - " . $sale->prix_vente . " € (" . $sale->created_at->format('d/m/Y') . ")\n";
}

echo "\n=== VOITURES VENDUES RÉCENTES ===\n";
$soldCars = Car::where('is_sold', true)->latest()->take(5)->get();
foreach ($soldCars as $car) {
    echo $car->marque . " " . $car->modele . " - " . $car->prix . " € (" . $car->updated_at->format('d/m/Y') . ")\n";
}
