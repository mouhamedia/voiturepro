@extends('layouts.main')

@section('title', 'VoiturePro - Trouvez l\'excellence automobile')

@section('content')
    <section style="background: linear-gradient(135deg, #1b1b18 0%, #2a2a26 100%); color: white; padding: 6rem 1rem; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(245, 48, 3, 0.15); border-radius: 50%; filter: blur(80px);"></div>
        
        <div style="max-width: 1200px; margin: 0 auto; text-align: center; position: relative; z-index: 2;">
            <span style="background: #F53003; color: white; padding: 0.5rem 1.2rem; border-radius: 2rem; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                Qualité Certifiée Professionnelle
            </span>
            <h1 style="font-size: clamp(2.5rem, 8vw, 4rem); font-weight: 800; margin: 1.5rem 0; line-height: 1.1;">
                Roulez en toute <span style="color: #F53003;">Confiance.</span>
            </h1>
            <p style="font-size: 1.2rem; color: rgba(255,255,255,0.8); max-width: 700px; margin: 0 auto 3rem;">
                Découvrez une sélection de véhicules inspectés avec soin, garantis et prêts pour la route. Le meilleur rapport qualité-prix du marché.
            </p>

            <form action="{{ route('cars.index') }}" method="GET" style="background: white; padding: 1rem; border-radius: 1rem; display: flex; flex-wrap: wrap; gap: 1rem; max-width: 900px; margin: 0 auto; box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
                <input type="text" name="search" placeholder="Quelle marque ou modèle ?" style="flex: 2; min-width: 200px; padding: 0.8rem; border: 1px solid #ddd; border-radius: 0.5rem; outline: none; color: #333;">
                
                <select name="budget" style="flex: 1; min-width: 150px; padding: 0.8rem; border: 1px solid #ddd; border-radius: 0.5rem; color: #333;">
                    <option value="">Budget max</option>
                    <option value="5000000">5 000 000 FCFA</option>
                    <option value="10000000">10 000 000 FCFA</option>
                    <option value="20000000">20 000 000 FCFA</option>
                </select>
                
                <button type="submit" style="flex: 1; min-width: 150px; background: #F53003; color: white; border: none; padding: 0.8rem; border-radius: 0.5rem; font-weight: 700; cursor: pointer; transition: 0.3s;">
                    <i class="fas fa-search"></i> Rechercher
                </button>
            </form>
        </div>
    </section>

    <section style="padding: 5rem 1rem; background: #fff;">
        <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem;">
            <div style="text-align: center;">
                <i class="fas fa-shield-alt" style="font-size: 2.5rem; color: #F53003; margin-bottom: 1rem;"></i>
                <h3 style="font-weight: 700;">Inspection 125 points</h3>
                <p style="color: #706f6c;">Chaque voiture est scrutée par nos experts avant la mise en vente.</p>
            </div>
            <div style="text-align: center;">
                <i class="fas fa-hand-holding-usd" style="font-size: 2.5rem; color: #F53003; margin-bottom: 1rem;"></i>
                <h3 style="font-weight: 700;">Prix Transparents</h3>
                <p style="color: #706f6c;">Aucun frais caché. Le prix affiché est le prix que vous payez.</p>
            </div>
            <div style="text-align: center;">
                <i class="fas fa-headset" style="font-size: 2.5rem; color: #F53003; margin-bottom: 1rem;"></i>
                <h3 style="font-weight: 700;">SAV Réactif</h3>
                <p style="color: #706f6c;">Une équipe dédiée pour vous accompagner même après l'achat.</p>
            </div>
        </div>
    </section>

    <section style="padding: 5rem 1rem; background: #f9f9f8;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem;">
                <div>
                    <h2 style="font-size: 2rem; font-weight: 800; color: #1b1b18;">Derniers Arrivages</h2>
                    <p style="color: #706f6c;">Découvrez nos nouveautés fraîchement postées</p>
                </div>
                <a href="{{ route('cars.index') }}" style="color: #F53003; font-weight: 700; text-decoration: none;">Voir tout le catalogue →</a>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                @forelse($recentCars as $car)
                    <div style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05); border: 1px solid #eee; transition: 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                        
                        <div style="position: relative; height: 220px; background: #f0f0f0;">
                            @php
                                $primaryImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                                $imagePath = $primaryImage ? $primaryImage->image_path : 'cars/default.jpg';
                            @endphp
                            
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $car->marque }} {{ $car->modele }}" style="width: 100%; height: 100%; object-fit: cover;">
                            
                            <div style="position: absolute; top: 1rem; left: 1rem; background: #F53003; color: white; padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-weight: 700; font-size: 0.9rem; box-shadow: 0 4px 10px rgba(245,48,3,0.3);">
                                @xof($car->prix)
                            </div>

                            @if($car->is_sold)
                                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center;">
                                    <span style="background: white; color: black; padding: 0.5rem 1.5rem; font-weight: 800; border-radius: 0.3rem; transform: rotate(-5deg);">VENDU</span>
                                </div>
                            @endif
                        </div>
                        
                        <div style="padding: 1.5rem;">
                            <h3 style="margin-bottom: 0.5rem; font-size: 1.2rem; font-weight: 700;">
                                {{ $car->marque }} <span style="color: #F53003;">{{ $car->modele }}</span>
                            </h3>
                            
                            <div style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                                <span style="background: #f4f4f2; padding: 0.3rem 0.6rem; border-radius: 0.4rem; font-size: 0.75rem; color: #555;">
                                    <i class="fas fa-calendar-alt"></i> {{ $car->annee }}
                                </span>
                                <span style="background: #f4f4f2; padding: 0.3rem 0.6rem; border-radius: 0.4rem; font-size: 0.75rem; color: #555;">
                                    <i class="fas fa-gas-pump"></i> {{ $car->carburant }}
                                </span>
                                <span style="background: #f4f4f2; padding: 0.3rem 0.6rem; border-radius: 0.4rem; font-size: 0.75rem; color: #555;">
                                    <i class="fas fa-cog"></i> {{ $car->boite }}
                                </span>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                <a href="{{ route('cars.show', $car->id) }}" style="text-align: center; border: 1px solid #1b1b18; color: #1b1b18; padding: 0.7rem; border-radius: 0.5rem; text-decoration: none; font-weight: 600; font-size: 0.85rem;">
                                    Détails
                                </a>
                                <a href="https://wa.me/VOTRE_NUMERO?text=Je suis intéressé par la {{ $car->marque }} {{ $car->modele }} affichée à @xof($car->prix)" 
                                   style="text-align: center; background: #25D366; color: white; padding: 0.7rem; border-radius: 0.5rem; text-decoration: none; font-weight: 600; font-size: 0.85rem;">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1/-1; text-align: center; padding: 3rem; background: white; border-radius: 1rem;">
                        <i class="fas fa-car-side" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <p style="color: #777;">Aucun véhicule n'est disponible pour le moment. Revenez bientôt !</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section style="padding: 5rem 1rem; text-align: center; background: #1b1b18; color: white;">
        <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1.5rem;">Vous ne trouvez pas votre bonheur ?</h2>
        <p style="margin-bottom: 2rem; opacity: 0.8;">Contactez-nous directement, nous pouvons trouver le véhicule de vos rêves sur commande.</p>
        <a href="tel:+221XXXXXXXXX" style="display: inline-block; background: #F53003; color: white; padding: 1rem 2.5rem; border-radius: 0.5rem; text-decoration: none; font-weight: 700; font-size: 1.1rem;">
            Nous Appeler Maintenant
        </a>
    </section>
@endsection