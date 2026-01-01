<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'modele',
        'annee',
        'kilometrage',
        'carburant',
        'boite',
        'prix',
        'statut',
        'is_sold',     // Vérifie que cette colonne existe
        'image',       // Obligatoire pour enregistrer le chemin
        'description', // Obligatoire
    ];

    protected $casts = [
        'sold_at' => 'datetime',
        'is_sold' => 'boolean',
        'prix' => 'decimal:2',
        'kilometrage' => 'integer',
        'annee' => 'integer',
    ];

    // Relation inverse : une voiture peut avoir plusieurs ventes
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Relation : une voiture peut avoir plusieurs images
     */
    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('is_primary', 'desc')->orderBy('order');
    }

    /**
     * Récupérer l'image principale (ou la première)
     */
    public function getPrimaryImage()
    {
        return $this->images()->where('is_primary', true)->first() 
            ?? $this->images()->first()
            ?? $this->image; // Fallback sur l'ancienne colonne image pour compatibilité
    }
}