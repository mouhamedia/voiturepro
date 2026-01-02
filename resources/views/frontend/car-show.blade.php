@extends('layouts.main')

@section('title', $car->marque . ' ' . $car->modele . ' - VoiturePro')

@section('extra-css')
<style>
    /* --- Styles Globaux --- */
    .breadcrumb a { color: #706f6c; text-decoration: none; transition: 0.3s; }
    .breadcrumb a:hover { color: #F53003; }
    .breadcrumb span { margin: 0 0.5rem; color: #ccc; }

    /* --- Galerie --- */
    .gallery-thumb {
        border: 2px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
        opacity: 0.7;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .gallery-thumb:hover, .gallery-thumb.active {
        border-color: #F53003;
        opacity: 1;
        transform: translateY(-2px);
    }

    /* --- Grille Responsive --- */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr; /* Mobile par défaut */
        gap: 2rem;
    }

    @media (min-width: 1024px) {
        .detail-grid {
            grid-template-columns: 1.2fr 0.8fr; /* Web : Image à gauche, infos à droite */
            gap: 3.5rem;
        }
    }

    .spec-card {
        background: #f8fafc;
        padding: 1rem;
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
    }

    .main-image-container {
        position: relative;
        margin-bottom: 1rem;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        height: 300px; /* Mobile height */
    }

    @media (min-width: 768px) {
        .main-image-container { height: 500px; }
    }

    .animate-fade { animation: fadeIn 0.5s ease forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection

@section('content')
    <nav style="background: white; border-bottom: 1px solid #f0f0ed; padding: 1rem 0;">
        <div class="container-custom" style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <div class="breadcrumb" style="font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; flex-wrap: wrap;">
                <a href="/"><i class="fas fa-home"></i></a>
                <span>/</span>
                <a href="/cars">Catalogue</a>
                <span>/</span>
                <span style="color: #1b1b18;">{{ $car->marque }} {{ $car->modele }}</span>
            </div>
        </div>
    </nav>

    <section style="padding: 2rem 0 4rem; background-color: white;">
        <div class="container-custom" style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <div class="detail-grid">
                
                <div class="animate-fade">
                    <div class="main-image-container">
                        @php
                            $primaryImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                            $imagePath = $primaryImage ? $primaryImage->image_path : 'cars/default.jpg';
                        @endphp

                        <img id="mainImage" src="{{ asset('storage/' . $imagePath) }}" 
                             alt="{{ $car->marque }}" style="width: 100%; height: 100%; object-fit: cover;">
                        
                        <div style="position: absolute; top: 1rem; left: 1rem;">
                            <span style="background: {{ $car->is_sold ? '#1b1b18' : '#27AE60' }}; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 800; font-size: 0.75rem; text-transform: uppercase;">
                                {{ $car->is_sold ? 'Déjà Vendu' : 'Disponible' }}
                            </span>
                        </div>
                    </div>

                    @if($car->images->count() > 1)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 0.8rem;">
                        @foreach($car->images as $img)
                            <div class="gallery-thumb" onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $img->image_path) }}'">
                                <img src="{{ asset('storage/' . $img->image_path) }}" style="width: 100%; height: 60px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="animate-fade" style="animation-delay: 0.1s;">
                    <div style="margin-bottom: 1.5rem;">
                        <span style="color: #F53003; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">{{ $car->marque }}</span>
                        <h1 style="font-size: clamp(2rem, 5vw, 3rem); font-weight: 900; color: #1b1b18; line-height: 1.1; margin: 0.3rem 0;">
                            {{ $car->modele }}
                        </h1>
                        <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1rem; flex-wrap: wrap;">
                            <div style="font-size: 2.2rem; font-weight: 900; color: #F53003;">@xof($car->prix)</div>
                            <div style="background: #fff5f2; color: #F53003; padding: 0.3rem 0.7rem; border-radius: 0.5rem; font-weight: 700; font-size: 0.8rem;">Taxes incluses</div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.8rem; margin-bottom: 2rem;">
                        <div class="spec-card">
                            <span style="font-size: 0.65rem; color: #64748b; text-transform: uppercase; font-weight: 700;">Année</span>
                            <span style="font-weight: 800; color: #1b1b18;">{{ $car->annee }}</span>
                        </div>
                        <div class="spec-card">
                            <span style="font-size: 0.65rem; color: #64748b; text-transform: uppercase; font-weight: 700;">Kilométrage</span>
                            <span style="font-weight: 800; color: #1b1b18;">{{ number_format($car->kilometrage, 0, ',', ' ') }} km</span>
                        </div>
                        <div class="spec-card">
                            <span style="font-size: 0.65rem; color: #64748b; text-transform: uppercase; font-weight: 700;">Énergie</span>
                            <span style="font-weight: 800; color: #1b1b18;">{{ $car->carburant }}</span>
                        </div>
                        <div class="spec-card">
                            <span style="font-size: 0.65rem; color: #64748b; text-transform: uppercase; font-weight: 700;">Transmission</span>
                            <span style="font-weight: 800; color: #1b1b18;">{{ $car->boite }}</span>
                        </div>
                    </div>

                    <div style="margin-bottom: 2rem; padding: 1.2rem; border-left: 4px solid #F53003; background: #fcfcfc;">
                        <h3 style="font-size: 1rem; font-weight: 800; margin-bottom: 0.5rem;">Note de l'expert</h3>
                        <p style="color: #475569; line-height: 1.6; font-size: 0.95rem; margin: 0;">
                            {{ $car->description ?: "Véhicule rigoureusement sélectionné. État irréprochable et garantie incluse." }}
                        </p>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                        <a href="https://wa.me/221XXXXXXXXX?text=Infos sur: {{ $car->marque }} {{ $car->modele }}" 
                           class="btn-whatsapp" style="padding: 1rem; border-radius: 0.8rem; font-weight: 800; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 1rem;">
                            <i class="fab fa-whatsapp" style="font-size: 1.3rem;"></i> Discuter sur WhatsApp
                        </a>
                        <a href="tel:+221XXXXXXXXX" style="background: #1b1b18; color: white; padding: 1rem; border-radius: 0.8rem; font-weight: 800; text-align: center; text-decoration: none; font-size: 1rem;">
                            <i class="fas fa-phone-alt" style="margin-right: 8px;"></i> Appeler un conseiller
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section style="padding: 4rem 0; background: #f8fafc; border-top: 1px solid #e2e8f0;">
        <div class="container-custom" style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h2 style="font-size: 1.8rem; font-weight: 900; color: #1b1b18; margin: 0;">Dans la même marque</h2>
                    <p style="color: #64748b; margin: 0;">D'autres pépites {{ $car->marque }}</p>
                </div>
                <a href="/cars" style="color: #F53003; font-weight: 800; text-decoration: none; border-bottom: 2px solid #F53003; font-size: 0.9rem;">Voir tout le stock</a>
            </div>

            @php
                $related = \App\Models\Car::where('marque', $car->marque)->where('id', '!=', $car->id)->limit(3)->get();
            @endphp

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                @forelse($related as $rel)
                    @include('partials.car-card', ['car' => $rel]) 
                @empty
                    <p style="color: #94a3b8;">Aucun autre modèle disponible pour le moment.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection