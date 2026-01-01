<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Convertir les valeurs existantes de prix_vente
     * de integer à decimal et s'assurer qu'elles sont correctes
     */
    public function up(): void
    {
        // Convertir tous les prix_vente en decimal avec 2 décimales
        DB::table('sales')->update([
            'prix_vente' => DB::raw('CAST(prix_vente AS DECIMAL(12,2))')
        ]);
    }

    public function down(): void
    {
        // Revert back to integer if needed
        DB::table('sales')->update([
            'prix_vente' => DB::raw('CAST(prix_vente AS INTEGER)')
        ]);
    }
};
