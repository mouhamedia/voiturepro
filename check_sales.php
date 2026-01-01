<?php
/**
 * Script de diagnostic - Vérifier l'état des ventes et du chiffre d'affaires
 */

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\Sale;

echo "═════════════════════════════════════════════════════════════\n";
echo "🔍 DIAGNOSTIC - CHIFFRE D'AFFAIRES\n";
echo "═════════════════════════════════════════════════════════════\n\n";

try {
    // 1. Vérifier la table Sales
    echo "1️⃣  Vérification de la table 'sales':\n";
    $salesTableExists = DB::connection()->getSchemaBuilder()->hasTable('sales');
    
    if (!$salesTableExists) {
        echo "❌ La table 'sales' N'EXISTE PAS ! C'est le problème.\n\n";
    } else {
        echo "✅ Table 'sales' existe\n";
        
        // Vérifier les colonnes
        $columns = DB::connection()->getSchemaBuilder()->getColumnListing('sales');
        echo "   Colonnes trouvées: " . implode(', ', $columns) . "\n\n";
    }

    // 2. Vérifier les voitures disponibles
    echo "2️⃣  Voitures VENDUES (is_sold = 1):\n";
    $soldCars = Car::where('is_sold', true)->count();
    echo "   Nombre de voitures marquées comme vendues: $soldCars\n\n";

    // 3. Vérifier les enregistrements dans Sales
    echo "3️⃣  Enregistrements dans la table 'sales':\n";
    
    if ($salesTableExists) {
        $salesCount = Sale::count();
        $totalRevenue = Sale::sum('prix_vente') ?? 0;
        
        echo "   Nombre total d'enregistrements: $salesCount\n";
        echo "   Chiffre d'affaires total: " . number_format($totalRevenue, 2, ',', ' ') . " €\n\n";
        
        // Afficher les dernières ventes
        if ($salesCount > 0) {
            echo "   Dernières ventes:\n";
            $recentSales = Sale::with('car')->latest()->limit(5)->get();
            
            foreach ($recentSales as $sale) {
                $carName = $sale->car ? $sale->car->marque . ' ' . $sale->car->modele : 'Voiture supprimée';
                echo "   - ID {$sale->id}: $carName | Prix: " . number_format($sale->prix_vente, 0, ',', ' ') . " € | Client: {$sale->client_nom}\n";
            }
        } else {
            echo "   ❌ Aucune vente enregistrée!\n";
        }
    }

    echo "\n4️⃣  Vérification de la cohérence:\n";
    echo "   Voitures vendues: $soldCars\n";
    if ($salesTableExists) {
        echo "   Ventes enregistrées: $salesCount\n";
        
        if ($soldCars === $salesCount) {
            echo "   ✅ Cohérence OK\n";
        } else {
            echo "   ⚠️  Incohérence détectée! Il y a " . abs($soldCars - $salesCount) . " ventes manquantes.\n";
        }
    }

} catch (\Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
}

echo "\n═════════════════════════════════════════════════════════════\n";
echo "FIN DU DIAGNOSTIC\n";
echo "═════════════════════════════════════════════════════════════\n";
