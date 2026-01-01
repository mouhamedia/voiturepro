<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'prix_vente',
        'client_nom',
        'client_telephone',
        'statut',
        'sold_at',
    ];

    // Casts pour assurer que les valeurs sont du bon type
    protected $casts = [
        'prix_vente' => 'decimal:2',
        'sold_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Une vente appartient à une voiture
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
