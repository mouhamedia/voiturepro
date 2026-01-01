<?php
// Charger Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Car;
use App\Models\Sale;

echo "\n═══════════════════════════════════════════════════════\n";
echo "DIAGNOSTIC DU CHIFFRE D'AFFAIRES\n";
echo "═══════════════════════════════════════════════════════\n\n";

// Vérifier les données
$totalCars = Car::count();
$soldCars = Car::where('is_sold', true)->count();
$salesRecords = Sale::count();
$totalRevenue = Sale::sum('prix_vente') ?? 0;

echo "📊 STATISTIQUES ACTUELLES:\n";
echo "   • Nombre total de voitures: $totalCars\n";
echo "   • Voitures marquées comme vendues: $soldCars\n";
echo "   • Enregistrements dans Sales: $salesRecords\n";
echo "   • Chiffre d'affaires total: " . number_format($totalRevenue, 2, ',', ' ') . " €\n\n";

if ($salesRecords > 0) {
    echo "📋 DERNIÈRES VENTES:\n";
    $recent = Sale::with('car')->latest()->limit(5)->get();
    foreach ($recent as $i => $sale) {
        $carInfo = $sale->car ? "{$sale->car->marque} {$sale->car->modele}" : "[Voiture supprimée]";
        echo "   " . ($i+1) . ". $carInfo - " . number_format($sale->prix_vente, 0, ',', ' ') . " € - {$sale->client_nom}\n";
    }
} else {
    echo "⚠️  Aucune vente trouvée dans la table 'sales'\n";
}

echo "\n═══════════════════════════════════════════════════════\n";
