<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Sale;
use App\Models\CarImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PARTIE PUBLIQUE (FRONTEND)
    |--------------------------------------------------------------------------
    */

    public function home()
    {
        $recentCars = Cache::remember('recent_cars_home', 3600, function () {
            return Car::with('images')
                ->where('is_sold', false)
                ->latest()
                ->take(6)
                ->get();
        });
        
        return view('frontend.home', compact('recentCars'));
    }

    public function index()
    {
        $cars = Car::with('images')
            ->where('is_sold', false)
            ->latest()
            ->paginate(12);
            
        return view('frontend.cars', compact('cars'));
    }

    /**
     * CORRECTION : Cette méthode manquait et causait l'erreur 500
     */
    public function soldCars()
    {
        $sold_cars = Car::with('images')
            ->where('is_sold', true)
            ->latest()
            ->paginate(12);
            
        return view('frontend.sold-cars', compact('sold_cars'));
    }

    public function show($id)
    {
        $car = Car::with('images')->findOrFail($id);
        return view('frontend.car-show', compact('car'));
    }

    /*
    |--------------------------------------------------------------------------
    | PARTIE ADMINISTRATION (BACKEND)
    |--------------------------------------------------------------------------
    */

    public function adminIndex(Request $request)
    {
        $query = Car::with('images');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('marque', 'LIKE', "%{$search}%")
                  ->orWhere('modele', 'LIKE', "%{$search}%");
            });
        }

        $cars = $query->latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marque'    => 'required|string|max:255',
            'modele'    => 'required|string|max:255',
            'prix'      => 'required|numeric|min:0',
            'images'    => 'required|array|min:1',
            'images.*'  => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $car = Car::create([
            'marque'      => $request->marque,
            'modele'      => $request->modele,
            'prix'        => $request->prix,
            'annee'       => $request->annee ?? date('Y'),
            'kilometrage' => $request->kilometrage ?? 0,
            'carburant'   => $request->carburant, 
            'boite'       => $request->boite,     
            'description' => $request->description,
            'is_sold'     => false,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'order'      => $index,
                ]);
            }
        }

        Cache::forget('recent_cars_home');
        return redirect()->route('admin.cars.index')->with('success', 'La pépite est en ligne !');
    }

    public function edit($id)
    {
        $car = Car::with('images')->findOrFail($id);
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'prix'   => 'required|numeric',
        ]);

        $car->update($request->only(['marque', 'modele', 'prix', 'carburant', 'boite', 'annee', 'kilometrage', 'description']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create([
                    'image_path' => $path,
                    'is_primary' => $car->images()->count() == 0,
                ]);
            }
        }

        Cache::forget('recent_cars_home');
        return redirect()->route('admin.cars.index')->with('success', 'Mise à jour réussie.');
    }

    public function markSold($id)
    {
        $car = Car::findOrFail($id);
        
        if ($car->is_sold) {
            return redirect()->back()->with('info', 'Déjà marqué comme vendu.');
        }

        $car->update(['is_sold' => true]);

        Sale::create([
            'car_id'           => $car->id,
            'prix_vente'       => $car->prix,
            'client_nom'       => 'Client Direct',
            'client_telephone' => '---',
            'sold_at'          => now(),
        ]);

        Cache::forget('recent_cars_home');
        return redirect()->back()->with('success', 'Vente enregistrée !');
    }

    public function destroy($id)
    {
        $car = Car::with('images')->findOrFail($id);
        
        foreach($car->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $car->delete();

        Cache::forget('recent_cars_home');
        return redirect()->route('admin.cars.index')->with('success', 'Supprimé définitivement.');
    }

    public function deleteImage($id)
    {
        $image = CarImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->back()->with('success', 'Image supprimée.');
    }
}