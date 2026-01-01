<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;
use App\Models\CarImage;

class MigrateCarImages extends Command
{
    protected $signature = 'migrate:car-images';
    protected $description = 'Migrer les images existantes vers la nouvelle table car_images';

    public function handle()
    {
        $this->info('🔄 MIGRATION DES IMAGES');
        $this->info('═══════════════════════════════════════════');
        $this->newLine();

        // Trouver les voitures avec une image mais sans entrées car_images
        $carsWithoutImages = Car::whereNotNull('image')
            ->whereDoesntHave('images')
            ->get();

        if ($carsWithoutImages->count() === 0) {
            $this->line('<fg=green>✅ Aucune image à migrer!</>');
            return Command::SUCCESS;
        }

        $this->warn('⚠️  ' . $carsWithoutImages->count() . ' voiture(s) avec image à migrer');
        $this->newLine();

        $this->line('📋 Création des enregistrements d\'images:');
        
        foreach ($carsWithoutImages as $car) {
            CarImage::create([
                'car_id' => $car->id,
                'image_path' => $car->image,
                'is_primary' => true,
                'order' => 0,
            ]);

            $this->line("  ✓ {$car->marque} {$car->modele}");
        }

        $this->newLine();
        $this->line('<fg=green>✅ MIGRATION COMPLÈTE!</>');
        $this->line("  • Voitures migrées: " . $carsWithoutImages->count());

        $this->info('═══════════════════════════════════════════');
        $this->newLine();

        return Command::SUCCESS;
    }
}
