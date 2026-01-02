@extends('layouts.main')

@section('title', 'VoiturePro - Trouvez l\'excellence automobile')

@section('content')
<style>
    :root { --brand-red: #F53003; --brand-dark: #1b1b18; }
    
    /* Animations */
    .hero-animate { animation: fadeInUp 0.8s ease-out; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* Utilitaires de structure */
    .container-custom { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }

    /* Badge Flexible */
    .badge-certified {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(245, 48, 3, 0.1);
        color: var(--brand-red);
        border: 1px solid var(--brand-red);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        max-width: 100%;
        font-size: 0.75rem;
    }

    /* Barre de recherche Web vs Mobile */
    .search-bar { 
        background: white; 
        padding: 0.6rem; 
        border-radius: 1rem; 
        display: flex; 
        gap: 0.5rem; 
        max-width: 900px; 
        margin: 0 auto; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    /* Grille de voitures compacte */
    .car-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .car-card { 
        transition: all 0.3s ease; 
        background: white; 
        border-radius: 1rem; 
        overflow: hidden; 
        border: 1px solid #f1f5f9;
    }
    .car-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }

    .image-zoom-container { overflow: hidden; height: 180px; position: relative; }
    .image-zoom-container img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
    
    .btn-whatsapp { background: #25D366; color: white !important; transition: 0.3s; }
    .btn-whatsapp:hover { background: #128C7E; }

    /* RESPONSIVE LOGIC */
    @media (max-width: 768px) {
        .search-bar { flex-direction: column; padding: 1rem; }
        .hero-title { font-size: 2.2rem !important; }
        .cta-section { flex-direction: column; text-align: center !important; }
        .cta-btns { width: 100%; justify-content: center; }
    }

    @media (min-width: 769px) {
        .hero-section { padding: 5rem 1rem !important; }
        .cta-section { display: flex; align-items: center; justify-content: space-between; text-align: left; }
    }
</style>

<section class="hero-section" style="background: linear-gradient(135deg, var(--brand-dark) 0%, #2a2a26 100%); color: white; padding: 6rem 1rem; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(245, 48, 3, 0.15); border-radius: 50%; filter: blur(80px);"></div>
    
    <div class="hero-animate container-custom" style="text-align: center; position: relative; z-index: 2;">
        <div class="badge-certified">
            <span>💎</span> Qualité Certifiée Professionnelle
        </div>
        
        <h1 class="hero-title" style="font-size: clamp(2rem, 6vw, 3.5rem); font-weight: 900; margin: 1.5rem 0; line-height: 1.1;">
            Roulez en toute <span style="color: var(--brand-red);">Confiance.</span>
        </h1>
        
        <p style="color: #a1a1aa; max-width: 600px; margin: 0 auto 2.5rem; font-size: 1.1rem;">
            Sélection exclusive de véhicules inspectés et garantis. Le prestige au meilleur prix.
        </p>

        <form action="{{ route('cars.index') }}" method="GET" class="search-bar">
            <div style="flex: 2; position: relative; display: flex; align-items: center;">
                <i class="fas fa-search" style="position: absolute; left: 1rem; color: #94a3b8;"></i>
                <input type="text" name="search" placeholder="Marque, modèle..." style="width: 100%; padding: 0.8rem 1rem 0.8rem 2.5rem; border: none; border-radius: 0.5rem; outline: none; background: #f8fafc;">
            </div>
            <select name="budget" style="flex: 1; padding: 0.8rem; border: none; background: #f8fafc; border-radius: 0.5rem; font-weight: 600;">
                <option value="">Budget Max</option>
                <option value="5000000">5M FCFA</option>
                <option value="15000000">15M FCFA</option>
            </select>
            <button type="submit" style="flex: 0.7; background: var(--brand-red); color: white; border: none; padding: 0.8rem; border-radius: 0.5rem; font-weight: 800; cursor: pointer;">
                RECHERCHER
            </button>
        </form>
    </div>
</section>

<section style="padding: 3rem 0; background: #f8fafc;">
    <div class="container-custom">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h2 style="font-size: 1.6rem; font-weight: 900; color: var(--brand-dark); margin: 0;">Derniers Arrivages</h2>
                <div style="width: 40px; height: 3px; background: var(--brand-red); margin-top: 5px;"></div>
            </div>
            <a href="{{ route('cars.index') }}" style="color: var(--brand-red); font-weight: 700; text-decoration: none; font-size: 0.85rem;">
                TOUT VOIR <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="car-grid">
            @forelse($recentCars as $car)
                <div class="car-card">
                    <div class="image-zoom-container">
                        @php
                            $primaryImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                            $imagePath = $primaryImage ? $primaryImage->image_path : 'cars/default.jpg';
                        @endphp
                        <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $car->marque }}">
                        <div style="position: absolute; bottom: 0.8rem; left: 0.8rem; background: var(--brand-red); color: white; padding: 0.3rem 0.8rem; border-radius: 0.5rem; font-weight: 800; font-size: 0.9rem;">
                            @xof($car->prix)
                        </div>
                    </div>
                    
                    <div style="padding: 1.2rem;">
                        <h3 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 0.8rem;">
                            {{ $car->marque }} <span style="color: var(--brand-red);">{{ $car->modele }}</span>
                        </h3>
                        
                        <div style="display: flex; gap: 0.4rem; margin-bottom: 1.2rem;">
                            <span style="background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.7rem; font-weight: 700;">{{ $car->annee }}</span>
                            <span style="background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.7rem; font-weight: 700;">{{ $car->carburant }}</span>
                            <span style="background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.7rem; font-weight: 700;">{{ $car->boite }}</span>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                            <a href="{{ route('cars.show', $car->id) }}" style="text-align: center; border: 1.5px solid var(--brand-dark); padding: 0.6rem; border-radius: 0.5rem; text-decoration: none; font-weight: 700; font-size: 0.75rem; color: var(--brand-dark);">DÉTAILS</a>
                            <a href="https://wa.me/221XXXXXXXXX" class="btn-whatsapp" style="text-align: center; padding: 0.6rem; border-radius: 0.5rem; text-decoration: none; font-weight: 700; font-size: 0.75rem; display: flex; align-items: center; justify-content: center; gap: 4px;">
                                <i class="fab fa-whatsapp"></i> WHATSAPP
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>

<section style="padding: 3rem 0; background: var(--brand-dark); color: white; border-top: 1px solid rgba(255,255,255,0.1);">
    <div class="container-custom">
        <div class="cta-section">
            <div style="margin-bottom: 1rem;">
                <h2 style="font-size: 1.8rem; font-weight: 900; margin: 0;">Prêt à changer de voiture ?</h2>
                <p style="color: #a1a1aa; margin: 5px 0 0 0;">Estimation gratuite et recherche personnalisée.</p>
            </div>
            
            <div class="cta-btns" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="tel:+221" style="background: var(--brand-red); color: white; padding: 0.8rem 1.5rem; border-radius: 0.6rem; text-decoration: none; font-weight: 800; font-size: 0.9rem;">
                    <i class="fas fa-phone-alt" style="margin-right: 8px;"></i> APPELEZ-NOUS
                </a>
                <a href="{{ route('cars.index') }}" style="background: rgba(255,255,255,0.1); color: white; padding: 0.8rem 1.5rem; border-radius: 0.6rem; text-decoration: none; font-weight: 800; font-size: 0.9rem; border: 1px solid rgba(255,255,255,0.2);">
                    NOTRE STOCK
                </a>
            </div>
        </div>
    </div>
</section>
@endsection