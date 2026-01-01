@extends('layouts.main')

@section('title', 'Catalogue de Voitures - VoiturePro')

@section('extra-css')
<style>
    /* --- Grille Responsive --- */
    .cars-grid {
        display: grid;
        grid-template-columns: 1fr; /* 1 colonne par défaut (Mobile) */
        gap: 2rem;
    }

    @media (min-width: 640px) {
        .cars-grid { grid-template-columns: repeat(2, 1fr); } /* 2 colonnes (Tablette) */
    }

    @media (min-width: 1024px) {
        .cars-grid { grid-template-columns: repeat(3, 1fr); } /* 3 colonnes (Desktop) */
    }

    /* --- Animations --- */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-slide { animation: slideUp 0.8s ease-out forwards; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    /* --- Cartes & Hover --- */
    .car-card {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid #e3e3e0;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .car-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        border-color: #F53003;
    }

    .car-image-container:hover img {
        transform: scale(1.1);
    }

    /* --- Adaptation Mobile spécifique --- */
    @media (max-width: 640px) {
        .header-title { font-size: 2.5rem !important; }
        .stats-grid { grid-template-columns: 1fr 1fr !important; }
    }
</style>
@endsection

@section('content')
    <section style="background: linear-gradient(135deg, #F53003 0%, #ff6b35 100%); color: white; padding: 5rem 1.5rem; text-align: center;">
        <div class="container">
            <div class="animate-slide">
                <span style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); color: white; padding: 0.5rem 1.5rem; border-radius: 3rem; font-size: 0.85rem; font-weight: 700; display: inline-block; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="fas fa-certificate" style="margin-right: 0.5rem;"></i> Qualité Certifiée
                </span>
            </div>
            <h1 class="header-title animate-slide delay-1" style="font-size: 3.5rem; font-weight: 800; margin-bottom: 1rem; letter-spacing: -1px;">
                Catalogue d'Exception
            </h1>
            <p class="animate-slide delay-2" style="font-size: 1.2rem; opacity: 0.9; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                Découvrez notre sélection de <strong>{{ $cars->total() }} véhicules</strong> rigoureusement inspectés pour votre sécurité et votre confort.
            </p>
        </div>
    </section>

    <section class="section" style="padding: 4rem 0; background-color: #f8f9fa;">
        <div class="container">
            
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1.5rem; margin-top: -7rem; margin-bottom: 3rem; position: relative; z-index: 10;">
                @php
                    $stats = [
                        ['val' => $cars->total(), 'label' => 'Véhicules', 'icon' => 'fa-car', 'color' => '#F53003'],
                        ['val' => '24/7', 'label' => 'Support Client', 'icon' => 'fa-headset', 'color' => '#3b82f6'],
                        ['val' => 'Garantie', 'label' => 'Inclus d\'office', 'icon' => 'fa-shield-alt', 'color' => '#27AE60'],
                        ['val' => 'Financement', 'label' => 'Sur mesure', 'icon' => 'fa-hand-holding-usd', 'color' => '#a855f7']
                    ];
                @endphp
                @foreach($stats as $stat)
                <div style="background: white; padding: 1.5rem; border-radius: 1rem; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.08); border-bottom: 4px solid {{ $stat['color'] }};">
                    <i class="fas {{ $stat['icon'] }}" style="color: {{ $stat['color'] }}; font-size: 1.2rem; margin-bottom: 0.5rem;"></i>
                    <div style="font-size: 1.5rem; font-weight: 800; color: #1b1b18;">{{ $stat['val'] }}</div>
                    <p style="color: #706f6c; font-size: 0.85rem; margin: 0; font-weight: 600;">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="animate-slide delay-2" style="background: white; padding: 1.5rem; border-radius: 1rem; margin-bottom: 3rem; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <form method="GET" action="/cars" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px; position: relative;">
                        <i class="fas fa-search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #999;"></i>
                        <input type="text" name="search" placeholder="Marque, modèle..." value="{{ request('search') }}"
                            style="width: 100%; padding: 1rem 1rem 1rem 3rem; border: 2px solid #f0f0ed; border-radius: 0.75rem; font-size: 1rem; outline: none; transition: 0.3s;"
                            onfocus="this.style.borderColor='#F53003'; this.style.boxShadow='0 0 0 4px rgba(245,48,3,0.1)'"
                            onblur="this.style.borderColor='#f0f0ed'; this.style.boxShadow='none'">
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem; border-radius: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">
                        Rechercher
                    </button>
                    @if(request('search'))
                        <a href="/cars" class="btn" style="background: #f0f0ed; color: #1b1b18; padding: 1rem; border-radius: 0.75rem;"><i class="fas fa-times"></i></a>
                    @endif
                </form>
            </div>

            @if($cars->count() > 0)
                <div class="cars-grid animate-slide delay-3">
                    @foreach($cars as $car)
                        <div class="car-card">
                            <div class="car-image-container" style="position: relative; height: 240px; overflow: hidden; background: #e3e3e0;">
                                @php
                                    $primaryImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                                    $imagePath = $primaryImage ? $primaryImage->image_path : $car->image;
                                @endphp

                                @if($imagePath)
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $car->marque }}" 
                                         style="width: 100%; height: 100%; object-fit: cover; transition: 0.6s ease;">
                                @else
                                    <div style="height: 100%; display: flex; align-items: center; justify-content: center; background: #eee;">
                                        <i class="fas fa-image fa-3x" style="color: #ccc;"></i>
                                    </div>
                                @endif
                                
                                <div style="position: absolute; top: 1rem; right: 1rem; display: flex; flex-direction: column; gap: 0.5rem;">
                                    <span style="background: {{ $car->is_sold ? '#dc3545' : '#27AE60' }}; color: white; padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                                        {{ $car->is_sold ? 'Vendu' : 'Disponible' }}
                                    </span>
                                </div>

                                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); padding: 2rem 1.25rem 1rem;">
                                    <div style="color: white; font-size: 1.5rem; font-weight: 800;">
                                        @xof($car->prix)
                                    </div>
                                </div>
                            </div>
                            
                            <div style="padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column;">
                                <h3 style="font-size: 1.3rem; font-weight: 800; color: #1b1b18; margin-bottom: 1rem;">
                                    {{ $car->marque }} <span style="color: #F53003;">{{ $car->modele }}</span>
                                </h3>
                                
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem; padding: 1rem 0; border-top: 1px solid #f0f0ed; border-bottom: 1px solid #f0f0ed;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #706f6c;">
                                        <i class="fas fa-calendar-alt" style="color: #F53003; width: 15px;"></i>
                                        <strong>{{ $car->annee ?? 'N/A' }}</strong>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #706f6c;">
                                        <i class="fas fa-gas-pump" style="color: #F53003; width: 15px;"></i>
                                        <strong>{{ $car->carburant ?? 'N/A' }}</strong>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #706f6c;">
                                        <i class="fas fa-tachometer-alt" style="color: #F53003; width: 15px;"></i>
                                        <strong>{{ number_format($car->kilometrage, 0, ',', ' ') }} km</strong>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #706f6c;">
                                        <i class="fas fa-cogs" style="color: #F53003; width: 15px;"></i>
                                        <strong>{{ $car->boite ?? 'Manuelle' }}</strong>
                                    </div>
                                </div>

                                <a href="/cars/{{ $car->id }}" class="btn btn-primary" 
                                   style="width: 100%; padding: 1rem; border-radius: 0.75rem; font-weight: 700; text-align: center; text-decoration: none; margin-top: auto; transition: 0.3s;">
                                    Détails du véhicule <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 4rem; display: flex; justify-content: center;">
                    {{ $cars->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 6rem 2rem; background: white; border-radius: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div style="width: 100px; height: 100px; background: #fff5f2; color: #F53003; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 2.5rem;">
                        <i class="fas fa-search-minus"></i>
                    </div>
                    <h3 style="font-size: 1.8rem; font-weight: 800; color: #1b1b18; margin-bottom: 1rem;">Aucun véhicule trouvé</h3>
                    <p style="color: #706f6c; max-width: 500px; margin: 0 auto 2.5rem; line-height: 1.6;">
                        Nous n'avons trouvé aucun résultat pour votre recherche. Essayez d'utiliser des termes plus généraux ou réinitialisez les filtres.
                    </p>
                    <a href="/cars" class="btn btn-primary" style="padding: 1rem 2.5rem; border-radius: 0.75rem; font-weight: 700;">
                        Afficher tout le stock
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection