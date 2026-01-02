@extends('layouts.main')

@section('title', $car->marque . ' ' . $car->modele . ' - VoiturePro')

@section('extra-css')
<style>
    :root { --brand-orange: #F53003; --brand-dark: #1b1b18; }

    /* --- Fil d'Ariane --- */
    .breadcrumb a { color: #706f6c; text-decoration: none; transition: 0.3s; }
    .breadcrumb a:hover { color: var(--brand-orange); }
    .breadcrumb span { margin: 0 0.5rem; color: #ccc; }

    /* --- Galerie --- */
    .gallery-thumb {
        border: 2px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
        opacity: 0.7;
        border-radius: 0.8rem;
        overflow: hidden;
        height: 70px;
    }
    .gallery-thumb:hover, .gallery-thumb.active {
        border-color: var(--brand-orange);
        opacity: 1;
        transform: translateY(-2px);
    }

    /* --- Grille Responsive --- */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    @media (min-width: 1024px) {
        .detail-grid { grid-template-columns: 1.2fr 0.8fr; gap: 4rem; }
    }

    .main-image-container {
        position: relative;
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
        height: 350px;
        background: #f8fafc;
    }
    @media (min-width: 768px) { .main-image-container { height: 550px; } }

    .spec-card {
        background: #f8fafc;
        padding: 1.2rem;
        border-radius: 1rem;
        border: 1px solid #f1f5f9;
        transition: 0.3s;
    }
    .spec-card:hover { background: white; border-color: var(--brand-orange); }

    /* --- Bouton WhatsApp --- */
    .btn-whatsapp {
        background: #25D366;
        color: white;
        padding: 1.2rem;
        border-radius: 1rem;
        font-weight: 800;
        text-align: center;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(37, 211, 102, 0.2);
    }
    .btn-whatsapp:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(37, 211, 102, 0.3); color: white; }

    .animate-fade { animation: fadeIn 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection

@section('content')
    <nav style="background: white; border-bottom: 1px solid #f1f5f9; padding: 1.2rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <div class="breadcrumb" style="font-size: 0.9rem; font-weight: 600; display: flex; align-items: center;">
                <a href="/"><i class="fas fa-home"></i></a>
                <span>/</span>
                <a href="/cars">Catalogue</a>
                <span>/</span>
                <span style="color: var(--brand-dark);">{{ $car->marque }} {{ $car->modele }}</span>
            </div>
        </div>
    </nav>

    <section style="padding: 3rem 0 5rem; background-color: white;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <div class="detail-grid">
                
                <div class="animate-fade">
                    <div class="main-image-container">
                        @php
                            $primaryImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                            $imagePath = $primaryImage ? $primaryImage->image_path : 'cars/default.jpg';
                        @endphp
                        <img id="mainImage" src="{{ asset('storage/' . $imagePath) }}" 
                             alt="{{ $car->marque }}" style="width: 100%; height: 100%; object-fit: cover; transition: 0.5s;">
                        
                        <div style="position: absolute; top: 1.5rem; left: 1.5rem;">
                            <span style="background: {{ $car->is_sold ? 'var(--brand-dark)' : '#22c55e' }}; color: white; padding: 0.6rem 1.2rem; border-radius: 0.8rem; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                                {{ $car->is_sold ? 'Déjà Vendu' : 'Disponible Immédiatement' }}
                            </span>
                        </div>
                    </div>

                    @if($car->images->count() > 1)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 1rem; margin-top: 1.5rem;">
                        @foreach($car->images as $img)
                            <div class="gallery-thumb {{ $img->image_path == $imagePath ? 'active' : '' }}" 
                                 onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $img->image_path) }}'; $('.gallery-thumb').removeClass('active'); $(this).addClass('active');">
                                <img src="{{ asset('storage/' . $img->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="animate-fade" style="animation-delay: 0.15s;">
                    <div style="margin-bottom: 2.5rem;">
                        <span style="color: var(--brand-orange); font-weight: 900; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem;">{{ $car->marque }}</span>
                        <h1 style="font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 900; color: var(--brand-dark); line-height: 1; margin: 0.5rem 0;">
                            {{ $car->modele }}
                        </h1>
                        <div style="display: flex; align-items: center; gap: 1.5rem; margin-top: 1.5rem;">
                            <div style="font-size: 2.8rem; font-weight: 900; color: var(--brand-dark); letter-spacing: -1px;">@xof($car->prix)</div>
                            <div style="background: #fff5f2; color: var(--brand-orange); padding: 0.5rem 1rem; border-radius: 0.8rem; font-weight: 800; font-size: 0.85rem; border: 1px solid rgba(245, 48, 3, 0.1);">PRIX TTC</div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 2.5rem;">
                        <div class="spec-card">
                            <span style="font-size: 0.7rem; color: #94a3b8; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Année</span>
                            <span style="font-weight: 900; color: var(--brand-dark); font-size: 1.1rem;">{{ $car->annee }}</span>
                        </div>
                        <div class="spec-card">
                            <span style="font-size: 0.7rem; color: #94a3b8; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Kilométrage</span>
                            <span style="font-weight: 900; color: var(--brand-dark); font-size: 1.1rem;">{{ number_format($car->kilometrage, 0, ',', ' ') }} km</span>
                        </div>
                        <div class="spec-card">
                            <span style="font-size: 0.7rem; color: #94a3b8; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Carburant</span>
                            <span style="font-weight: 900; color: var(--brand-dark); font-size: 1.1rem;">{{ $car->carburant }}</span>
                        </div>
                        <div class="spec-card">
                            <span style="font-size: 0.7rem; color: #94a3b8; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Boîte</span>
                            <span style="font-weight: 900; color: var(--brand-dark); font-size: 1.1rem;">{{ $car->boite }}</span>
                        </div>
                    </div>

                    <div style="margin-bottom: 3rem; padding: 1.5rem; border-radius: 1.5rem; background: #fcfcfc; border: 1px solid #f1f5f9; position: relative;">
                        <i class="fas fa-quote-left" style="position: absolute; top: -10px; left: 20px; font-size: 1.5rem; color: var(--brand-orange); opacity: 0.2;"></i>
                        <h3 style="font-size: 1rem; font-weight: 900; margin-bottom: 0.8rem; color: var(--brand-dark);">Description de l'expert</h3>
                        <p style="color: #64748b; line-height: 1.7; font-size: 1rem; margin: 0;">
                            {{ $car->description ?: "Ce véhicule a passé avec succès notre test de 125 points de contrôle. Historique limpide et entretien à jour." }}
                        </p>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <a href="https://wa.me/221XXXXXXXXX?text=Bonjour, je souhaite des informations sur la {{ $car->marque }} {{ $car->modele }} affichée à @xof($car->prix)" 
                           target="_blank" class="btn-whatsapp">
                            <i class="fab fa-whatsapp" style="font-size: 1.5rem;"></i> RÉSERVER VIA WHATSAPP
                        </a>
                        <a href="tel:+221XXXXXXXXX" style="background: var(--brand-dark); color: white; padding: 1.2rem; border-radius: 1rem; font-weight: 800; text-align: center; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 0.8rem;">
                            <i class="fas fa-phone-alt"></i> CONTACTER UN CONSEILLER
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section style="padding: 5rem 0; background: #fafafa; border-top: 1px solid #f1f5f9;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem;">
                <div>
                    <h2 style="font-size: 2rem; font-weight: 900; color: var(--brand-dark); margin: 0;">Modèles similaires</h2>
                    <p style="color: #94a3b8; font-weight: 600; margin-top: 0.5rem;">Sélectionnés pour vous chez {{ $car->marque }}</p>
                </div>
                <a href="/cars" style="color: var(--brand-orange); font-weight: 800; text-decoration: none; border-bottom: 2px solid var(--brand-orange); padding-bottom: 4px;">Voir tout le stock</a>
            </div>

            @php
                $related = \App\Models\Car::where('marque', $car->marque)
                            ->where('id', '!=', $car->id)
                            ->limit(3)
                            ->get();
            @endphp

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                @forelse($related as $rel)
                    @include('partials.car-card', ['car' => $rel]) 
                @empty
                    <div style="grid-column: 1/-1; text-align: center; padding: 3rem; background: white; border-radius: 1.5rem; border: 2px dashed #e2e8f0;">
                        <p style="color: #94a3b8; font-weight: 600; margin: 0;">Aucun autre modèle {{ $car->marque }} n'est disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection