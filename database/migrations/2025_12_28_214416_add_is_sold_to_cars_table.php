<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // On vérifie chaque colonne avant de l'ajouter pour éviter les doublons
            if (!Schema::hasColumn('cars', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('cars', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('cars', 'is_sold')) {
                $table->boolean('is_sold')->default(false);
            }
            if (!Schema::hasColumn('cars', 'carburant')) {
                $table->string('carburant')->nullable();
            }
            if (!Schema::hasColumn('cars', 'boite')) {
                $table->string('boite')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Ici, on liste les colonnes à supprimer si on annule la migration
            $table->dropColumn(['image', 'description', 'is_sold', 'carburant', 'boite']);
        });
    }
};