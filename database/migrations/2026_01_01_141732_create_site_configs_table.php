<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Très important pour l'insertion directe

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Création de la table secrète
        Schema::create('site_configs', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Clé unique (ex: is_active)
            $table->string('value');         // Valeur (ex: ON ou OFF)
            $table->timestamps();
        });

        // 2. Insertion de la sécurité par défaut
        // Le site est actif ("ON") dès l'installation
        DB::table('site_configs')->insert([
            [
                'key' => 'is_active', 
                'value' => 'ON',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_configs');
    }
};