<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corriger le champ prix_vente de integer à decimal
     * et ajouter une colonne sold_at
     */
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // Modifier le type de prix_vente d'integer à decimal
            $table->decimal('prix_vente', 12, 2)->change();
            
            // Ajouter une colonne sold_at si elle n'existe pas
            if (!Schema::hasColumn('sales', 'sold_at')) {
                $table->timestamp('sold_at')->useCurrent()->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // Revert prix_vente back to integer
            $table->integer('prix_vente')->change();
            
            // Drop sold_at column
            if (Schema::hasColumn('sales', 'sold_at')) {
                $table->dropColumn('sold_at');
            }
        });
    }
};
