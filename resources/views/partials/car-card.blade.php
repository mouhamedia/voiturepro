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
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem; padding: 1.25rem 0; border-top: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; color: #475569;">
                <i class="fas fa-calendar" style="color: var(--brand-orange);"></i>
                <strong>{{ $car->annee }}</strong>
            </div>
            <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; color: #475569;">
                <i class="fas fa-road" style="color: var(--brand-orange);"></i>
                <strong>{{ number_format($car->kilometrage, 0, ',', ' ') }} km</strong>
            </div>
        </div>

        <a href="{{ route('cars.show', $car->id) }}" 
           style="width: 100%; padding: 1.1rem; border-radius: 1rem; background: var(--brand-dark); color: white; font-weight: 800; text-align: center; text-decoration: none; margin-top: auto; transition: 0.3s; text-transform: uppercase; font-size: 0.85rem;">
            Détails <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
        </a>
    </div>
</div>