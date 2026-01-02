@extends('layouts.main')

@section('title', 'Catalogue Automobile - VoiturePro')

@section('extra-css')
<style>
    :root { --brand-orange: #F53003; --brand-dark: #1b1b18; }

    /* --- Grille Responsive --- */
    .cars-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2.5rem;
    }

    /* --- Animations --- */
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-entry { animation: slideUpFade 0.7s cubic-bezier(0.23, 1, 0.32, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }

    /* --- Cartes --- */
    .car-card {
        background: white;
        border-radius: 1.5rem;
        overflow: hidden;
        border: 1px solid #f1f1ee;
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .car-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        border-color: var(--brand-orange);
    }

    .image-wrapper { position: relative; height: 250px; overflow: hidden; }
    .image-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease; }
    .car-card:hover .image-wrapper img { transform: scale(1.1); }

    /* --- Stats Bar --- */
    .floating-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: -4rem;
        position: relative;
        z-index: 50;
    }

    /* Custom Pagination */
    .pagination { display: flex; gap: 0.5rem; list-style: none; padding: 0; }
    .page-item.active .page-link { background: var(--brand-orange); border-color: var(--brand-orange); }
</style>
@endsection

@section('content')
    <section style="background: var(--brand-dark); color: white; padding: 6rem 1.5rem 10rem; text-align: center; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 20% 50%, rgba(245, 48, 3, 0.15) 0%, transparent 50%);"></div>
        
        <div class="container animate-entry" style="position: relative;">
            <span style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: white; padding: 0.6rem 1.5rem; border-radius: 3rem; font-size: 0.8rem; font-weight: 700; display: inline-block; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 2px;">
                💎 Collection Privée {{ date('Y') }}
            </span>
            <h1 style="font-size: clamp(2.5rem, 8vw, 4rem); font-weight: 900; margin-bottom: 1rem; letter-spacing: -2px;">
                Catalogue <span style="color: var(--brand-orange);">Premium</span>
            </h1>
            <p style="font-size: 1.2rem; color: #a1a1aa; max-width: 650px; margin: 0 auto; line-height: 1.6;">
                Parcourez notre flotte de <strong>{{ $cars->total() }}</strong> véhicules d'exception, certifiés et disponibles immédiatement.
            </p>
        </div>
    </section>

    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
        
        <div class="floating-stats animate-entry delay-1">
            @php
                $stats = [
                    ['val' => $cars->total(), 'label' => 'Véhicules en Stock', 'icon' => 'fa-car-side', 'color' => '#F53003'],
                    ['val' => '125 pts', 'label' => 'Points d\'Inspection', 'icon' => 'fa-clipboard-check', 'color' => '#3b82f6'],
                    ['val' => 'Inclus', 'label' => 'Garantie Totale', 'icon' => 'fa-shield-heart', 'color' => '#27AE60'],
                    ['val' => 'Sur Mesure', 'label' => 'Options de Crédit', 'icon' => 'fa-coins', 'color' => '#a855f7']
                ];
            @endphp
            @foreach($stats as $stat)
            <div style="background: white; padding: 1.5rem; border-radius: 1.25rem; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-top: 5px solid {{ $stat['color'] }};">
                <i class="fas {{ $stat['icon'] }}" style="color: {{ $stat['color'] }}; font-size: 1.5rem; margin-bottom: 0.75rem; opacity: 0.8;"></i>
                <div style="font-size: 1.6rem; font-weight: 900; color: var(--brand-dark); line-height: 1.2;">{{ $stat['val'] }}</div>
                <p style="color: #64748b; font-size: 0.85rem; margin-top: 5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="animate-entry delay-2" style="background: white; padding: 1.5rem; border-radius: 1.5rem; margin: 3rem 0; box-shadow: 0 4px 25px rgba(0,0,0,0.05); border: 1px solid #f1f1ee;">
            <form method="GET" action="{{ route('cars.index') }}" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                <div style="flex: 1; min-width: 300px; position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 1.2rem; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="text" name="search" placeholder="Chercher une BMW, une Toyota, un SUV..." value="{{ request('search') }}"
                        style="width: 100%; padding: 1.1rem 1rem 1.1rem 3.5rem; border: 2px solid #f8fafc; background: #f8fafc; border-radius: 1rem; font-size: 1rem; outline: none; transition: 0.3s; font-weight: 500;">
                </div>
                <button type="submit" style="background: var(--brand-dark); color: white; border: none; padding: 1.1rem 2.5rem; border-radius: 1rem; font-weight: 800; cursor: pointer; transition: 0.3s; text-transform: uppercase; letter-spacing: 1px;">
                    Filtrer
                </button>
                @if(request('search'))
                    <a href="{{ route('cars.index') }}" style="background: #fee2e2; color: #dc2626; padding: 1.1rem; border-radius: 1rem; text-decoration: none;"><i class="fas fa-times"></i></a>
                @endif
            </form>
        </div>

        @if($cars->count() > 0)
            <div class="cars-grid animate-entry" style="animation-delay: 0.4s; padding-bottom: 5rem;">
                @foreach($cars as $car)
                    <div class="car-card">
                        <div class="image-wrapper">
                            @php
                                $primaryImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                                $imagePath = $primaryImage ? $primaryImage->image_path : 'cars/default.jpg';
                            @endphp

                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $car->marque }}">
                            
                            <div style="position: absolute; top: 1.25rem; left: 1.25rem;">
                                <span style="background: {{ $car->is_sold ? '#1e293b' : '#22c55e' }}; color: white; padding: 0.5rem 1rem; border-radius: 0.75rem; font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                                    {{ $car->is_sold ? 'Indisponible' : 'Disponible' }}
                                </span>
                            </div>

                            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 3rem 1.5rem 1.25rem;">
                                <div style="color: white; font-size: 1.8rem; font-weight: 900; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                                    @xof($car->prix)
                                </div>
                            </div>
                        </div>
                        
                        <div style="padding: 2rem; flex-grow: 1; display: flex; flex-direction: column;">
                            <h3 style="font-size: 1.4rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 0.5rem; line-height: 1.2;">
                                {{ $car->marque }} <span style="color: var(--brand-orange);">{{ $car->modele }}</span>
                            </h3>
                            <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 1.5rem; font-weight: 600;">Ref: #VP-{{ 1000 + $car->id }}</p>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem; padding: 1.25rem 0; border-top: 1px solid #f1f5f9;">
                                <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; color: #475569;">
                                    <i class="fas fa-calendar" style="color: var(--brand-orange); font-size: 1rem;"></i>
                                    <strong>{{ $car->annee ?? 'N/A' }}</strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; color: #475569;">
                                    <i class="fas fa-road" style="color: var(--brand-orange); font-size: 1rem;"></i>
                                    <strong>{{ number_format($car->kilometrage, 0, ',', ' ') }} km</strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; color: #475569;">
                                    <i class="fas fa-gas-pump" style="color: var(--brand-orange); font-size: 1rem;"></i>
                                    <strong>{{ $car->carburant ?? 'N/A' }}</strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; color: #475569;">
                                    <i class="fas fa-cog" style="color: var(--brand-orange); font-size: 1rem;"></i>
                                    <strong>{{ $car->boite ?? 'Manuelle' }}</strong>
                                </div>
                            </div>

                            <a href="{{ route('cars.show', $car->id) }}" 
                               style="width: 100%; padding: 1.2rem; border-radius: 1rem; background: var(--brand-dark); color: white; font-weight: 800; text-align: center; text-decoration: none; margin-top: auto; transition: all 0.3s; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px;">
                                Explorer le véhicule <i class="fas fa-chevron-right" style="margin-left: 10px; font-size: 0.8rem;"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 2rem; display: flex; justify-content: center; padding-bottom: 5rem;">
                {{ $cars->appends(request()->query())->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 8rem 2rem; background: white; border-radius: 2rem; border: 2px dashed #e2e8f0; margin-bottom: 5rem;">
                <div style="width: 120px; height: 120px; background: #f8fafc; color: #cbd5e1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 3rem;">
                    <i class="fas fa-search"></i>
                </div>
                <h3 style="font-size: 2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 1rem;">Zéro résultat</h3>
                <p style="color: #64748b; max-width: 450px; margin: 0 auto 2.5rem; line-height: 1.6; font-size: 1.1rem;">
                    Il semble que nous n'ayons pas ce véhicule en stock pour le moment. Essayez de réinitialiser vos filtres.
                </p>
                <a href="{{ route('cars.index') }}" style="background: var(--brand-orange); color: white; padding: 1.2rem 3rem; border-radius: 1rem; text-decoration: none; font-weight: 800; box-shadow: 0 10px 20px rgba(245,48,3,0.2);">
                    Réinitialiser la recherche
                </a>
            </div>
        @endif
    </div>
@endsection