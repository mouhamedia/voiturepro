@extends('layouts.main')

@section('title', 'Succès de Nos Ventes - VoiturePro')

@section('extra-css')
<style>
    :root { 
        --brand-success: #10b981; /* Vert émeraude plus moderne */
        --brand-dark: #0f172a;    /* Bleu-noir plus profond */
        --brand-light: #f8fafc;
    }

    /* --- Animations Fluides --- */
    @keyframes reveal {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-reveal { animation: reveal 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }

    /* --- Header & Container --- */
    .hero-sold {
        background: radial-gradient(circle at top right, #1e293b, var(--brand-dark));
        position: relative;
        overflow: hidden;
    }
    .hero-sold::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
        opacity: 0.05;
    }

    .container-custom { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; }

    /* --- Cartes "Collection" --- */
    .sold-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }

    .sold-card {
        background: white;
        border-radius: 1.5rem;
        border: 1px solid #f1f5f9;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .sold-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        border-color: #e2e8f0;
    }

    /* Badge Vendu Signature */
    .sold-badge {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
        z-index: 2;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(4px);
        color: var(--brand-dark);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 800;
        font-size: 0.7rem;
        letter-spacing: 1px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .sold-img-wrapper {
        height: 240px;
        border-radius: 1.5rem 1.5rem 0 0;
        overflow: hidden;
    }
    .sold-img-wrapper img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 1s ease;
    }
    .sold-card:hover .sold-img-wrapper img {
        transform: scale(1.1);
    }

    /* --- Stats Flottantes --- */
    .stats-card {
        background: white;
        padding: 1.5rem;
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px -5px rgba(0,0,0,0.05);
        text-align: center;
        transition: 0.3s;
    }
    .stats-card:hover { transform: scale(1.05); }

</style>
@endsection

@section('content')
    <section class="hero-sold" style="padding: 6rem 0 8rem; text-align: center; color: white;">
        <div class="container-custom">
            <div class="animate-reveal">
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); padding: 6px 16px; border-radius: 100px; margin-bottom: 2rem;">
                    <span style="width: 8px; height: 8px; background: var(--brand-success); border-radius: 50%; display: inline-block;"></span>
                    <span style="font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;">Excellence Reconnue</span>
                </div>
                <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">
                    Ils nous ont fait <span style="color: var(--brand-success)">confiance.</span>
                </h1>
                <p style="font-size: 1.25rem; color: #94a3b8; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                    Explorez notre galerie de ventes réussies. Chaque véhicule raconte une histoire de passion et de qualité sans compromis.
                </p>
            </div>
        </div>
    </section>

    <div class="container-custom" style="margin-top: -4rem; position: relative; z-index: 5;">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; @media (min-width: 768px) { grid-template-columns: repeat(4, 1fr); gap: 2rem; }">
            @php $stats = [
                ['val' => $sold_cars->total(), 'lab' => 'Ventes', 'icon' => 'fa-check', 'color' => '#10b981'],
                ['val' => '100%', 'lab' => 'Qualité', 'icon' => 'fa-shield-alt', 'color' => '#f59e0b'],
                ['val' => '4.9/5', 'lab' => 'Avis', 'icon' => 'fa-star', 'color' => '#3b82f6'],
                ['val' => '< 48h', 'lab' => 'Rapidité', 'icon' => 'fa-bolt', 'color' => '#a855f7']
            ]; @endphp
            @foreach($stats as $stat)
                <div class="stats-card animate-reveal">
                    <div style="width: 40px; height: 40px; background: {{ $stat['color'] }}15; color: {{ $stat['color'] }}; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas {{ $stat['icon'] }}"></i>
                    </div>
                    <div style="font-size: 1.75rem; font-weight: 900; color: var(--brand-dark);">{{ $stat['val'] }}</div>
                    <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-top: 4px;">{{ $stat['lab'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <section style="padding: 6rem 0; background: #fafafa;">
        <div class="container-custom">
            @if($sold_cars->count() > 0)
                <div class="sold-grid">
                    @foreach($sold_cars as $index => $car)
                        <div class="sold-card animate-reveal" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="sold-badge">VENDU PAR VOITUREPRO</div>
                            
                            <div class="sold-img-wrapper">
                                @php
                                    $primaryImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                                    $imagePath = $primaryImage ? $primaryImage->image_path : 'cars/default.jpg';
                                @endphp
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $car->marque }}">
                            </div>

                            <div style="padding: 2rem;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                                    <div>
                                        <h3 style="font-size: 1.4rem; font-weight: 900; color: var(--brand-dark); margin: 0;">{{ $car->marque }}</h3>
                                        <p style="color: var(--brand-success); font-weight: 700; margin: 0;">{{ $car->modele }}</p>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 0.7rem; color: #94a3b8; font-weight: 700; text-transform: uppercase;">Prix de vente</div>
                                        <div style="font-size: 1.1rem; font-weight: 800; color: var(--brand-dark);">@xof($car->prix)</div>
                                    </div>
                                </div>

                                <div style="display: flex; gap: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-calendar-day" style="color: #cbd5e1;"></i>
                                        <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">{{ $car->annee }}</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-tachometer-alt" style="color: #cbd5e1;"></i>
                                        <span style="font-size: 0.85rem; font-weight: 600; color: #64748b;">{{ number_format($car->kilometrage, 0, ',', ' ') }} km</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 5rem; display: flex; justify-content: center;">
                    {{ $sold_cars->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 10rem 0;">
                    <div style="background: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
                        <i class="fas fa-camera-retro fa-2x" style="color: #e2e8f0;"></i>
                    </div>
                    <p style="color: #94a3b8; font-size: 1.1rem; font-weight: 500;">Notre galerie est en cours de préparation.</p>
                </div>
            @endif
        </div>
    </section>

    <section style="background: white; padding: 6rem 0;">
        <div class="container-custom">
            <div style="background: var(--brand-dark); border-radius: 2.5rem; padding: 4rem 2rem; text-align: center; position: relative; overflow: hidden;">
                <div style="position: relative; z-index: 2;">
                    <h2 style="color: white; font-size: 2.5rem; font-weight: 900; margin-bottom: 1rem;">Votre prochaine voiture ici ?</h2>
                    <p style="color: #94a3b8; font-size: 1.1rem; max-width: 500px; margin: 0 auto 2.5rem;">Rejoignez le cercle privilégié de nos clients satisfaits.</p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="/cars" style="background: var(--brand-success); color: white; padding: 1.25rem 2.5rem; border-radius: 1rem; font-weight: 800; text-decoration: none; transition: 0.3s; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);">
                            Explorer le Catalogue
                        </a>
                        <a href="/contact" style="background: rgba(255,255,255,0.05); color: white; border: 1px solid rgba(255,255,255,0.1); padding: 1.25rem 2.5rem; border-radius: 1rem; font-weight: 800; text-decoration: none; transition: 0.3s;">
                            Service Personnalisé
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection