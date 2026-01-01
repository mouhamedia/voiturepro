<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->integer('annee');
            $table->integer('kilometrage')->nullable();
            $table->string('carburant')->nullable();
            $table->string('boite')->nullable(); // manuelle / auto
            $table->integer('prix');
            $table->string('statut')->default('disponible');
            // disponible | vendue | archivee
            $table->timestamp('sold_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
