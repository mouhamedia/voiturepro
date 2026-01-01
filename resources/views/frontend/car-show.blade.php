@extends('layouts.main')

@section('title', $car->marque . ' ' . $car->modele . ' - VoiturePro')
@section('description', 'Découvrez les détails de ce(tte) ' . $car->marque . ' ' . $car->modele)

@section('content')
    <!-- Breadcrumb -->
    <section style="padding: 1.5rem; background-color: #f9f9f8;">
        <div class="container">
            <div class="breadcrumb">
                <a href="/">Accueil</a>
                <span>/</span>
                <a href="/cars">Catalogue</a>
                <span>/</span>
                <span>{{ $car->marque }} {{ $car->modele }}</span>
            </div>
        </div>
    </section>

    <!-- Car Details -->
    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr; gap: 2rem; align-items: start; @media (min-width: 768px) { grid-template-columns: 1fr 1fr; }">
                <!-- Image Section with Gallery -->
                <div style="animation: slideInFromLeft 0.6s ease-out;">
                    <!-- Image Principale -->
                    <div style="position: relative; margin-bottom: 1.5rem;">
                        @php
                            $primaryImage = $car->images->where('is_primary', true)->first() 
                                         ?? $car->images->first() 
                                         ?? $car;
                            $imagePath = $primaryImage instanceof \App\Models\CarImage 
                                       ? $primaryImage->image_path 
                                       : $primaryImage->image;
                        @endphp

                        @if($imagePath)
                            <img 
                                id="mainImage"
                                src="{{ asset('storage/' . $imagePath) }}" 
                                alt="{{ $car->marque }} {{ $car->modele }}"
                                style="width: 100%; height: auto; border-radius: 0.75rem; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); transition: transform 0.4s ease; cursor: zoom-in;"
                            >
                        @else
                            <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #e0e0e0, #f0f0f0); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #999;">
                                <div style="text-align: center;">
                                    <i class="fas fa-car" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                    <p>Image non disponible</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Badge Status -->
                        @if($car->is_sold)
                            <div style="position: absolute; top: 1rem; right: 1rem; background: #F53003; color: white; padding: 0.75rem 1.5rem; border-radius: 0.375rem; font-weight: 700; font-size: 0.9rem;">
                                <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i> Vendue
                            </div>
                        @else
                            <div style="position: absolute; top: 1rem; right: 1rem; background: #27AE60; color: white; padding: 0.75rem 1.5rem; border-radius: 0.375rem; font-weight: 700; font-size: 0.9rem;">
                                <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i> Disponible
                            </div>
                        @endif
                    </div>

                    <!-- Galerie de Miniatures -->
                    @if($car->images && $car->images->count() > 0)
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 0.75rem;">
                            @foreach($car->images as $image)
                                <div 
                                    style="border-radius: 0.5rem; height: 80px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease; border: 3px solid transparent; overflow: hidden;"
                                    onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $image->image_path) }}'; document.querySelectorAll('[data-image-thumbnail]').forEach(el => el.style.borderColor='transparent'); this.style.borderColor='#F53003';"
                                    data-image-thumbnail
                                >
                                    <img 
                                        src="{{ asset('storage/' . $image->image_path) }}" 
                                        alt="Miniature"
                                        style="width: 100%; height: 100%; object-fit: cover;"
                                    >
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #999; text-align: center; padding: 1rem;">Pas d'autres images disponibles</p>
                    @endif
                </div>

                <!-- Info Section -->
                <div style="animation: slideInFromRight 0.6s ease-out;">
                    <!-- Header -->
                    <div style="margin-bottom: 2rem;">
                        <h1 style="font-size: 2.5rem; font-weight: 700; color: #1b1b18; margin-bottom: 0.5rem;">
                            {{ $car->marque }} {{ $car->modele }}
                        </h1>
                        <p style="color: #706f6c; font-size: 1rem;">
                            <i class="fas fa-calendar"></i> {{ $car->annee ?? '2024' }}
                        </p>
                    </div>

                    <!-- Price -->
                    <div style="background: linear-gradient(135deg, #fff2f2, #ffe8e8); padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; border-left: 4px solid #F53003;">
                        <p style="color: #706f6c; font-size: 0.9rem; margin-bottom: 0.5rem;">Prix</p>
                        <p style="font-size: 2.5rem; font-weight: 700; color: #F53003;">
                            @xof($car->prix)
                        </p>
                    </div>

                    <!-- Key Features -->
                    <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; border: 1px solid #e3e3e0; margin-bottom: 2rem;">
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1b1b18; margin-bottom: 1.5rem;">
                            Caractéristiques
                        </h3>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            @if($car->carburant)
                                <div style="padding-bottom: 1rem;">
                                    <p style="color: #706f6c; font-size: 0.85rem; margin-bottom: 0.25rem;">
                                        <i class="fas fa-gas-pump" style="margin-right: 0.5rem;"></i> Carburant
                                    </p>
                                    <p style="font-weight: 600; color: #1b1b18;">{{ $car->carburant }}</p>
                                </div>
                            @endif

                            @if($car->boite)
                                <div style="padding-bottom: 1rem;">
                                    <p style="color: #706f6c; font-size: 0.85rem; margin-bottom: 0.25rem;">
                                        <i class="fas fa-cogs" style="margin-right: 0.5rem;"></i> Transmission
                                    </p>
                                    <p style="font-weight: 600; color: #1b1b18;">{{ $car->boite }}</p>
                                </div>
                            @endif

                            @if($car->kilometrage)
                                <div style="padding-bottom: 1rem;">
                                    <p style="color: #706f6c; font-size: 0.85rem; margin-bottom: 0.25rem;">
                                        <i class="fas fa-tachometer-alt" style="margin-right: 0.5rem;"></i> Kilométrage
                                    </p>
                                    <p style="font-weight: 600; color: #1b1b18;">{{ number_format($car->kilometrage, 0, ',', ' ') }} km</p>
                                </div>
                            @endif

                            <div style="padding-bottom: 1rem;">
                                <p style="color: #706f6c; font-size: 0.85rem; margin-bottom: 0.25rem;">
                                    <i class="fas fa-calendar-check" style="margin-right: 0.5rem;"></i> Année
                                </p>
                                <p style="font-weight: 600; color: #1b1b18;">{{ $car->annee ?? '2024' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($car->description)
                        <div style="margin-bottom: 2rem;">
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1b1b18; margin-bottom: 1rem;">
                                Description
                            </h3>
                            <p style="color: #706f6c; line-height: 1.6; white-space: pre-wrap;">
                                {{ $car->description }}
                            </p>
                        </div>
                    @endif

                    <!-- CTA Buttons -->
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
                        <a href="/cars" class="btn btn-secondary" style="border-color: #F53003; color: #F53003;">
                            <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i> Retour au Catalogue
                        </a>
                        <a href="#contact" class="btn btn-primary">
                            <i class="fas fa-envelope" style="margin-right: 0.5rem;"></i> Me Contacter
                        </a>
                    </div>

                    <!-- Info Box -->
                    <div style="background: #f9f9f8; padding: 1.5rem; border-radius: 0.75rem;">
                        <h4 style="font-weight: 700; color: #1b1b18; margin-bottom: 0.75rem;">
                            <i class="fas fa-shield-alt" style="margin-right: 0.5rem; color: #F53003;"></i> 100% Certifié
                        </h4>
                        <p style="color: #706f6c; font-size: 0.9rem;">
                            Tous nos véhicules sont inspectés, certifiés et prêts à être utilisés en toute confiance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Cars -->
    <section class="section" style="background-color: #f9f9f8;">
        <div class="container">
            <h2 class="section-title animate-slide-up" style="margin-bottom: 2rem;">
                Voitures Similaires
            </h2>

            @php
                $relatedCars = \App\Models\Car::where('marque', $car->marque)
                    ->where('id', '!=', $car->id)
                    ->limit(6)
                    ->get();
            @endphp

            @if($relatedCars->count() > 0)
                <div style="display: grid; grid-template-columns: 1fr; gap: 2rem; @media (min-width: 640px) { grid-template-columns: repeat(2, 1fr); } @media (min-width: 1024px) { grid-template-columns: repeat(3, 1fr); }">
                    @foreach($relatedCars as $relatedCar)
                        <div style="background: white; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; hover: { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15); }">
                            <div style="position: relative; height: 250px; overflow: hidden;">
                                @php
                                    $relatedPrimaryImage = $relatedCar->images->where('is_primary', true)->first() 
                                                        ?? $relatedCar->images->first() 
                                                        ?? $relatedCar;
                                    $relatedImagePath = $relatedPrimaryImage instanceof \App\Models\CarImage 
                                                      ? $relatedPrimaryImage->image_path 
                                                      : $relatedPrimaryImage->image;
                                @endphp

                                @if($relatedImagePath)
                                    <img 
                                        src="{{ asset('storage/' . $relatedImagePath) }}" 
                                        alt="{{ $relatedCar->marque }} {{ $relatedCar->modele }}"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;"
                                    >
                                @else
                                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #e0e0e0, #f0f0f0); display: flex; align-items: center; justify-content: center; color: #999;">
                                        <i class="fas fa-car" style="font-size: 2.5rem; opacity: 0.5;"></i>
                                    </div>
                                @endif

                                <!-- Badge Status -->
                                @if($relatedCar->is_sold)
                                    <div style="position: absolute; top: 10px; right: 10px; background: #F53003; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 700; font-size: 0.8rem;">
                                        <i class="fas fa-check-circle" style="margin-right: 0.25rem;"></i> Vendue
                                    </div>
                                @else
                                    <div style="position: absolute; top: 10px; right: 10px; background: #27AE60; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 700; font-size: 0.8rem;">
                                        <i class="fas fa-check-circle" style="margin-right: 0.25rem;"></i> Disponible
                                    </div>
                                @endif

                                <!-- Price Badge -->
                                <div style="position: absolute; bottom: 10px; left: 10px; background: white; color: #F53003; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 700; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
                                    @xof($relatedCar->prix)
                                </div>
                            </div>

                            <div style="padding: 1.5rem;">
                                <h3 style="font-size: 1.1rem; font-weight: 700; color: #1b1b18; margin-bottom: 0.5rem;">
                                    {{ $relatedCar->marque }} <span style="color: #F53003;">{{ $relatedCar->modele }}</span>
                                </h3>
                                <p style="color: #706f6c; font-size: 0.9rem; margin-bottom: 1rem;">
                                    <i class="fas fa-calendar"></i> {{ $relatedCar->annee ?? '2024' }}
                                </p>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem; font-size: 0.85rem; border-bottom: 1px solid #e3e3e0; padding-bottom: 1rem;">
                                    @if($relatedCar->carburant)
                                        <div>
                                            <span style="color: #706f6c;"><i class="fas fa-gas-pump"></i> {{ $relatedCar->carburant }}</span>
                                        </div>
                                    @endif
                                    @if($relatedCar->boite)
                                        <div>
                                            <span style="color: #706f6c;"><i class="fas fa-cogs"></i> {{ $relatedCar->boite }}</span>
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('cars.show', $relatedCar->id) }}" style="display: inline-block; width: 100%; text-align: center; background: #F53003; color: white; padding: 0.75rem; border-radius: 0.375rem; font-weight: 700; text-decoration: none; transition: all 0.3s ease; hover: { background: #d41f00; }">
                                    <i class="fas fa-eye" style="margin-right: 0.5rem;"></i> Voir Plus
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="background: white; padding: 3rem; border-radius: 0.75rem; text-align: center;">
                    <i class="fas fa-car" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                    <p style="color: #706f6c; font-size: 1rem;">Aucune voiture similaire disponible pour le moment</p>
                </div>
            @endif
        </div>
    </section>
@endsection