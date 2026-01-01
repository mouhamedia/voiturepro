@extends('layouts.app')

@section('title', 'Catalogue de Voitures - VoiturePro')

@section('extra-css')
<style>
    /* --- Grille Responsive (Correction du CSS Inline) --- */
    .cars-grid {
        display: grid;
        grid-template-columns: 1fr; /* 1 colonne sur mobile */
        gap: 2rem;
        margin-top: 1rem;
    }

    @media (min-width: 768px) {
        .cars-grid { grid-template-columns: repeat(2, 1fr); } /* 2 colonnes sur tablette */
    }

    @media (min-width: 1024px) {
        .cars-grid { grid-template-columns: repeat(3, 1fr); } /* 3 colonnes sur PC */
    }

    /* --- Animations --- */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: slideUp 0.8s ease-out forwards;
    }

    /* --- Adaptabilité Mode Sombre --- */
    body.dark-mode .info-card, 
    body.dark-mode .filter-section, 
    body.dark-mode .car-card {
        background-color: #1a1a1a !important;
        border-color: #333 !important;
    }

    body.dark-mode .car-title { color: #fff !important; }
    body.dark-mode .spec-label { color: #bbb !important; }

    /* --- Style des cartes --- */
    .car-card {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #e3e3e0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .car-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
    <section style="background: linear-gradient(135deg, #F53003 0%, #ff6b35 100%); color: white; padding: 5rem 1.5rem; text-align: center;">
        <div class="container">
            <div class="animate-fade-in">
                <span style="background: rgba(255, 255, 255, 0.2); color: white; padding: 0.5rem 1.5rem; border-radius: 3rem; font-size: 0.85rem; font-weight: 600; display: inline-block; margin-bottom: 1.5rem;">
                    <i class="fas fa-star" style="margin-right: 0.5rem;"></i> Trouvez Votre Voiture Idéale
                </span>
                <h1 style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 1rem; line-height: 1.1;">
                    Catalogue Complet
                </h1>
                <p style="font-size: 1.2rem; opacity: 0.95; max-width: 700px; margin: 0 auto;">
                    {{ $cars->total() }} véhicules inspectés et certifiés. Filtrez, comparez et trouvez la vôtre.
                </p>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: -3rem; position: relative; z-index: 5;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            @php $stats = [
                ['val' => $cars->total(), 'lab' => 'Disponibles', 'col' => '#F53003'],
                ['val' => '24/7', 'lab' => 'Support', 'col' => '#3b82f6'],
                ['val' => '30j', 'lab' => 'Garantie', 'col' => '#27AE60'],
                ['val' => '4.8★', 'lab' => 'Avis', 'col' => '#a855f7']
            ]; @endphp
            @foreach($stats as $stat)
                <div class="info-card" style="background: white; padding: 1.25rem; border-radius: 0.75rem; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid {{ $stat['col'] }};">
                    <div style="font-size: 1.5rem; font-weight: 800; color: {{ $stat['col'] }};">{{ $stat['val'] }}</div>
                    <p style="color: #706f6c; font-size: 0.8rem; text-transform: uppercase; font-weight: 600;">{{ $stat['lab'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="filter-section" style="background: white; padding: 1.5rem; border-radius: 1rem; margin-bottom: 3rem; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
            <form method="GET" action="/cars" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 280px;">
                    <input type="text" name="search" placeholder="Rechercher une marque ou un modèle..." 
                        value="{{ request('search') }}"
                        style="width: 100%; padding: 1rem; border: 2px solid #eee; border-radius: 0.5rem; outline: none; transition: 0.3s;"
                        onfocus="this.style.borderColor='#F53003'">
                </div>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem; font-weight: 700; border-radius: 0.5rem; cursor: pointer;">
                    <i class="fas fa-search"></i> Rechercher
                </button>
                @if(request('search'))
                    <a href="/cars" style="padding: 1rem; color: #706f6c; text-decoration: none; font-weight: 600;">Effacer</a>
                @endif
            </form>
        </div>

        @if($cars->count() > 0)
            <div class="cars-grid">
                @foreach($cars as $car)
                    <div class="car-card animate-fade-in">
                        <div style="position: relative; height: 220px; overflow: hidden; background: #f0f0f0;">
                            @php
                                $imagePath = $car->images->where('is_primary', true)->first()->image_path ?? $car->image;
                            @endphp
                            
                            @if($imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $car->marque }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="height: 100%; display: flex; items-center; justify-content: center; background: #eee; color: #ccc;">
                                    <i class="fas fa-car fa-3x"></i>
                                </div>
                            @endif

                            <div style="position: absolute; top: 12px; right: 12px; background: {{ $car->is_sold ? '#f53003' : '#27AE60' }}; color: white; padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">
                                {{ $car->is_sold ? 'Vendue' : 'En Stock' }}
                            </div>
                        </div>

                        <div style="padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                                <h3 class="car-title" style="font-size: 1.25rem; font-weight: 700; margin: 0;">{{ $car->marque }} <span style="color: #F53003;">{{ $car->modele }}</span></h3>
                            </div>
                            
                            <div style="font-size: 1.1rem; font-weight: 800; color: #F53003; margin-bottom: 1rem;">
                                @xof($car->prix)
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1.5rem; border-top: 1px solid #f0f0f0; padding-top: 1rem;">
                                <div style="font-size: 0.8rem;">
                                    <span class="spec-label" style="color: #999; display: block;">Année</span>
                                    <strong>{{ $car->annee ?? 'N/A' }}</strong>
                                </div>
                                <div style="font-size: 0.8rem;">
                                    <span class="spec-label" style="color: #999; display: block;">Carburant</span>
                                    <strong>{{ $car->carburant ?? 'N/A' }}</strong>
                                </div>
                                <div style="font-size: 0.8rem;">
                                    <span class="spec-label" style="color: #999; display: block;">Kilométrage</span>
                                    <strong>{{ number_format($car->kilometrage, 0, ',', ' ') }} km</strong>
                                </div>
                                <div style="font-size: 0.8rem;">
                                    <span class="spec-label" style="color: #999; display: block;">Transmission</span>
                                    <strong>{{ $car->boite ?? 'Manuelle' }}</strong>
                                </div>
                            </div>

                            <a href="/cars/{{ $car->id }}" class="btn btn-primary" style="margin-top: auto; width: 100%; text-align: center; padding: 0.8rem; font-weight: 700; text-decoration: none; border-radius: 0.5rem;">
                                Voir les Détails
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 4rem; display: flex; justify-content: center;">
                {{ $cars->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 5rem 0;">
                <i class="fas fa-search fa-4x" style="color: #eee; margin-bottom: 1rem;"></i>
                <h3 style="color: #706f6c;">Aucun véhicule ne correspond à votre recherche.</h3>
                <a href="/cars" class="btn btn-primary" style="display: inline-block; margin-top: 1rem;">Réinitialiser les filtres</a>
            </div>
        @endif
    </div>
@endsection