<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class FixMissingSales extends Command
{
    protected $signature = 'fix:missing-sales';
    protected $description = 'Créer automatiquement les enregistrements de vente manquants';

    public function handle()
    {
        $this->info('🔧 CORRECTION DES VENTES MANQUANTES');
        $this->info('═══════════════════════════════════════════');
        $this->newLine();

        // Trouver toutes les voitures vendues sans enregistrement de vente
        $soldCarsWithoutSale = Car::where('is_sold', true)
            ->whereDoesntHave('sales')
            ->get();

        if ($soldCarsWithoutSale->count() === 0) {
            $this->line('<fg=green>✅ Aucune vente manquante trouvée!</>');
            return Command::SUCCESS;
        }

        $this->warn('⚠️  ' . $soldCarsWithoutSale->count() . ' voiture(s) vendue(s) sans enregistrement!');
        $this->newLine();

        // Créer les enregistrements manquants
        $this->line('📋 Création des enregistrements:');
        
        foreach ($soldCarsWithoutSale as $car) {
            Sale::create([
                'car_id'           => $car->id,
                'prix_vente'       => (float) $car->prix,
                'client_nom'       => 'Vente Historique',
                'client_telephone' => '---',
                'statut'           => 'valide',
                'sold_at'          => $car->updated_at ?? now(),
            ]);

            $this->line("  ✓ {$car->marque} {$car->modele} - " . number_format($car->prix, 2, ',', ' ') . " €");
        }

        $this->newLine();

        // Afficher le nouveau total
        $totalRevenue = Sale::sum('prix_vente') ?? 0;
        $salesCount = Sale::count();

        $this->line('<fg=green>✅ CORRECTION COMPLÈTE!</>');
        $this->line("  • Total enregistrements: $salesCount");
        $this->line("  • Chiffre d'affaires: <info>" . number_format($totalRevenue, 2, ',', ' ') . " €</info>");

        $this->info('═══════════════════════════════════════════');
        $this->newLine();

        return Command::SUCCESS;
    }
}
