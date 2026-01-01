<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;
use App\Models\Sale;

class CheckRevenue extends Command
{
    protected $signature = 'check:revenue';
    protected $description = 'Vérifier et afficher le chiffre d\'affaires';

    public function handle()
    {
        $this->info('═══════════════════════════════════════════');
        $this->info('📊 VÉRIFICATION DU CHIFFRE D\'AFFAIRES');
        $this->info('═══════════════════════════════════════════');
        $this->newLine();

        // Récupérer les statistiques
        $totalCars = Car::count();
        $soldCars = Car::where('is_sold', true)->count();
        $salesCount = Sale::count();
        $totalRevenue = Sale::sum('prix_vente') ?? 0;

        // Afficher les statistiques
        $this->info('📈 STATISTIQUES:');
        $this->line("  • Total voitures: <info>$totalCars</info>");
        $this->line("  • Voitures vendues: <info>$soldCars</info>");
        $this->line("  • Enregistrements de vente: <info>$salesCount</info>");
        $this->line("  • Chiffre d'affaires: <info>" . number_format($totalRevenue, 2, ',', ' ') . " €</info>");
        $this->newLine();

        // Afficher les dernières ventes si elles existent
        if ($salesCount > 0) {
            $this->info('📋 LES 5 DERNIÈRES VENTES:');
            $recentSales = Sale::with('car')->latest()->limit(5)->get();
            
            foreach ($recentSales as $i => $sale) {
                $carInfo = $sale->car ? "{$sale->car->marque} {$sale->car->modele}" : "[Voiture supprimée]";
                $this->line("  " . ($i+1) . ". $carInfo");
                $this->line("     Prix: <comment>" . number_format($sale->prix_vente, 2, ',', ' ') . " €</comment> | Client: {$sale->client_nom}");
            }
        } else {
            $this->warn('⚠️  Aucune vente enregistrée');
        }

        // Vérifier la cohérence
        $this->newLine();
        $this->info('🔍 VÉRIFICATION DE LA COHÉRENCE:');
        if ($soldCars === $salesCount) {
            $this->line('<fg=green>✅ Cohérence OK</> - Chaque voiture vendue a un enregistrement dans sales');
        } else {
            $this->line('<fg=red>⚠️  PROBLÈME DÉTECTÉ</> - ' . abs($soldCars - $salesCount) . ' ventes manquantes!');
        }

        $this->info('═══════════════════════════════════════════');
        $this->newLine();

        return Command::SUCCESS;
    }
}
