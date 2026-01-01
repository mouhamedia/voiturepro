@extends('layouts.main')

@section('title', 'Succès de Nos Ventes - VoiturePro')

@section('extra-css')
<style>
    /* --- Grille Responsive --- */
    .sold-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    @media (min-width: 640px) { .sold-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (min-width: 1024px) { .sold-grid { grid-template-columns: repeat(3, 1fr); } }

    /* --- Style des Cartes Vendues --- */
    .sold-card {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid #e3e3e0;
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .sold-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(39, 174, 96, 0.15);
        border-color: #27AE60;
    }

    /* Effet visuel sur les images vendues */
    .sold-img-container {
        position: relative;
        height: 250px;
        overflow: hidden;
    }
    
    .sold-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(40%); /* Un peu plus gris pour le côté "archive" */
        transition: 0.5s ease;
    }

    .sold-card:hover img {
        filter: grayscale(0%);
        transform: scale(1.05);
    }

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-up { animation: fadeInUp 0.6s ease-out forwards; }
</style>
@endsection

@section('content')
    <section style="background: linear-gradient(135deg, #1e7d46 0%, #27AE60 100%); color: white; padding: 5rem 1.5rem; text-align: center;">
        <div class="container">
            <div class="animate-up">
                <span style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); color: white; padding: 0.5rem 1.5rem; border-radius: 3rem; font-size: 0.85rem; font-weight: 700; display: inline-block; margin-bottom: 1.5rem; text-transform: uppercase;">
                    <i class="fas fa-handshake" style="margin-right: 0.5rem;"></i> Confiance & Satisfaction
                </span>
                <h1 style="font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 1rem; letter-spacing: -1px;">
                    Histoires de Succès
                </h1>
                <p style="font-size: 1.2rem; opacity: 0.9; max-width: 750px; margin: 0 auto; line-height: 1.6;">
                    Plus de <strong>{{ $sold_cars->total() }} véhicules</strong> ont déjà trouvé preneur. 
                    Découvrez les modèles qui font le bonheur de nos clients.
                </p>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: -4rem; position: relative; z-index: 10;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1.5rem; margin-bottom: 4rem;">
            @php $stats = [
                ['val' => $sold_cars->total(), 'lab' => 'Ventes Réussies', 'col' => '#27AE60', 'icon' => 'fa-check-double'],
                ['val' => '100%', 'lab' => 'Satisfaction', 'col' => '#f59e0b', 'icon' => 'fa-smile'],
                ['val' => '4.9/5', 'lab' => 'Avis Clients', 'col' => '#3b82f6', 'icon' => 'fa-star'],
                ['val' => 'Rapide', 'lab' => 'Délai Vente', 'col' => '#a855f7', 'icon' => 'fa-bolt']
            ]; @endphp
            @foreach($stats as $stat)
                <div class="animate-up" style="background: white; padding: 1.5rem; border-radius: 1rem; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-bottom: 4px solid {{ $stat['col'] }};">
                    <i class="fas {{ $stat['icon'] }}" style="color: {{ $stat['col'] }}; margin-bottom: 0.75rem; font-size: 1.2rem;"></i>
                    <div style="font-size: 1.8rem; font-weight: 800; color: #1b1b18;">{{ $stat['val'] }}</div>
                    <p style="color: #706f6c; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin: 0;">{{ $stat['lab'] }}</p>
                </div>
            @endforeach
        </div>

        @if($sold_cars->count() > 0)
            <div class="sold-grid">
                @foreach($sold_cars as $index => $car)
                    <div class="sold-card animate-up" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="sold-img-container">
                            @php
                                $primaryImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                                $imagePath = $primaryImage ? $primaryImage->image_path : $car->image;
                            @endphp
                            
                            @if($imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $car->marque }}">
                            @else
                                <div style="height: 100%; display: flex; align-items: center; justify-content: center; background: #f0f0f0; color: #ccc;">
                                    <i class="fas fa-car fa-4x"></i>
                                </div>
                            @endif

                            <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(39, 174, 96, 0.9); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 800; font-size: 0.8rem; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                                <i class="fas fa-lock" style="margin-right: 0.4rem;"></i> VENDU
                            </div>
                        </div>

                        <div style="padding: 1.5rem; flex-grow: 1;">
                            <h3 style="font-size: 1.25rem; font-weight: 800; color: #1b1b18; margin-bottom: 0.5rem;">
                                {{ $car->marque }} <span style="color: #27AE60;">{{ $car->modele }}</span>
                            </h3>
                            <div style="font-size: 1.1rem; font-weight: 700; color: #706f6c; margin-bottom: 1.5rem;">
                                @xof($car->prix)
                            </div>

                            <div style="display: flex; gap: 1rem; border-top: 1px solid #eee; padding-top: 1rem; margin-bottom: 1.5rem;">
                                <div style="font-size: 0.85rem; color: #706f6c;">
                                    <i class="fas fa-calendar-alt" style="color: #27AE60;"></i> {{ $car->annee }}
                                </div>
                                <div style="font-size: 0.85rem; color: #706f6c;">
                                    <i class="fas fa-tachometer-alt" style="color: #27AE60;"></i> {{ number_format($car->kilometrage, 0, ',', ' ') }} km
                                </div>
                            </div>

                            <div style="background: #f0fdf4; border: 1px dashed #27AE60; border-radius: 0.75rem; padding: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 35px; height: 35px; background: #27AE60; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fas fa-check" style="font-size: 0.8rem;"></i>
                                </div>
                                <div style="font-size: 0.85rem; font-weight: 700; color: #1e7d46;">
                                    Propriétaire satisfait
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 4rem; display: flex; justify-content: center;">
                {{ $sold_cars->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 5rem 0;">
                <h3 style="color: #706f6c;">Aucun historique de vente disponible.</h3>
            </div>
        @endif
    </div>

    <section style="background: #1b1b18; color: white; padding: 5rem 1.5rem; margin-top: 5rem; text-align: center;">
        <div class="container animate-up">
            <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1.5rem;">Prêt à être notre prochain succès ?</h2>
            <p style="font-size: 1.2rem; opacity: 0.8; max-width: 600px; margin: 0 auto 2.5rem;">
                Parcourez notre stock actuel et trouvez la voiture qui vous correspond.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="/cars" class="btn btn-primary" style="background: #27AE60; border: none; padding: 1.2rem 3rem; font-weight: 700; border-radius: 0.75rem; color: white; text-decoration: none;">
                    Voir le Catalogue Actuel
                </a>
                <a href="/contact" class="btn" style="border: 2px solid white; color: white; padding: 1.2rem 3rem; font-weight: 700; border-radius: 0.75rem; text-decoration: none;">
                    Nous Contacter
                </a>
            </div>
        </div>
    </section>
@endsection