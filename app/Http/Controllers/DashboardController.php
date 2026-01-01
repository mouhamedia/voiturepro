<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $monthStart = Carbon::now()->startOfMonth();

        // Calcul du chiffre d'affaires avec la bonne colonne
        $totalSalesAmount = Sale::sum('prix_vente') ?? 0;

        return view('admin.dashboard', [
            'totalCars' => Car::count(),
            
            // Statistiques de ventes (basées sur le nombre de lignes)
            'soldCarsToday' => Sale::whereDate('created_at', $today)->count(),
            'soldCarsWeek' => Sale::where('created_at', '>=', $weekStart)->count(),
            'soldCarsMonth' => Sale::where('created_at', '>=', $monthStart)->count(),

            // Cartes du Dashboard
            'totalSales' => $totalSalesAmount, // Chiffre d'affaires correct
            'carsInStock' => Car::where('is_sold', false)->count(), 
            'totalSold' => Car::where('is_sold', true)->count(),
            'stockValue' => Car::where('is_sold', false)->sum('prix') ?? 0, 
            
            // Tableau des ventes récentes
            'recentSales' => Sale::with('car')->latest()->take(5)->get(),
            
            // Voitures récentes
            'recent_cars' => Car::latest()->take(10)->get(),
            
            // Voitures vendues récentes
            'soldCars' => Car::where('is_sold', true)->latest()->take(10)->get(),
        ]);
    }
}