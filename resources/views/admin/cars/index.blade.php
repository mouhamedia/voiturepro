@extends('layouts.admin')

@section('title', 'Gestion des Voitures - VoiturePro Admin')

@section('content')
    <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; padding: 2.5rem 1.5rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-size: 2.2rem; font-weight: 900; margin: 0 0 0.5rem 0; text-transform: uppercase; letter-spacing: -1px;">
                        Gestion du Parc
                    </h1>
                    <p style="color: #e0e7ff; font-style: italic; margin: 0; opacity: 0.9;">
                        {{ $cars->count() }} véhicule(s) en inventaire
                    </p>
                </div>
                <div style="font-size: 3.5rem; opacity: 0.2;">
                    <i class="fas fa-car-side"></i>
                </div>
            </div>
        </div>
    </div>

    <section style="padding: 2rem 1rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
                <a href="{{ route('admin.cars.create') }}" style="display: inline-flex; align-items: center; padding: 0.85rem 1.75rem; background: #27AE60; color: white; font-weight: 700; border-radius: 0.5rem; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);">
                    <i class="fas fa-plus-circle" style="margin-right: 0.6rem;"></i> Ajouter une Voiture
                </a>
                
                <div style="background: white; padding: 0.5rem 1rem; border-radius: 2rem; border: 1px solid #e3e3e0; font-size: 0.85rem; color: #666; font-weight: 600;">
                    <span style="color: #27AE60;">●</span> {{ $cars->where('is_sold', false)->count() }} Dispos
                </div>
            </div>

            <div style="background: white; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #eef0f2;">
                @if($cars && $cars->count() > 0)
                    <div class="mobile-grid" style="padding: 1rem;">
                        @foreach($cars as $car)
                            <div style="background: white; border: 1px solid #eee; border-radius: 0.75rem; margin-bottom: 1rem; overflow: hidden; display: flex; flex-direction: column;">
                                <div style="position: relative;">
                                    @php
                                        $imagePath = ($car->images && $car->images->count() > 0) ? $car->images->first()->image_path : $car->image;
                                    @endphp
                                    <img src="{{ $imagePath ? asset('storage/' . $imagePath) : 'https://via.placeholder.com/400x250?text=Pas+de+Photo' }}" 
                                         style="width: 100%; height: 180px; object-fit: cover;">
                                    
                                    <div style="position: absolute; top: 10px; right: 10px;">
                                        @if($car->is_sold)
                                            <span style="background: #ef4444; color: white; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Vendu</span>
                                        @else
                                            <span style="background: #22c55e; color: white; padding: 0.3rem 0.8rem; border-radius: 2rem; font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">En Stock</span>
                                        @endif
                                    </div>
                                </div>
                                <div style="padding: 1rem;">
                                    <h3 style="margin: 0; font-size: 1.1rem; color: #1a1a1a;">{{ $car->marque }} {{ $car->modele }}</h3>
                                    <p style="margin: 0.3rem 0; color: #666; font-size: 0.85rem;">{{ $car->annee }} • {{ number_format($car->kilometrage, 0, ',', ' ') }} km</p>
                                    <p style="margin: 0.5rem 0; color: #1e40af; font-size: 1.2rem; font-weight: 900;">
                                        {{ number_format($car->prix, 0, ',', ' ') }} FCFA
                                    </p>
                                    
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.5rem; margin-top: 1rem;">
                                        <a href="{{ route('admin.cars.edit', $car->id) }}" style="background: #eff6ff; color: #2563eb; padding: 0.6rem; border-radius: 0.5rem; text-align: center; font-size: 0.9rem;"><i class="fas fa-edit"></i></a>
                                        
                                        @if(!$car->is_sold)
                                        <form action="{{ route('admin.cars.markSold', $car->id) }}" method="POST">
                                            @csrf
                                            <button style="width: 100%; background: #f0fdf4; color: #16a34a; padding: 0.6rem; border-radius: 0.5rem; border: none;"><i class="fas fa-check"></i></button>
                                        </form>
                                        @else
                                        <div></div>
                                        @endif

                                        <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Supprimer définitivement ?');">
                                            @csrf @method('DELETE')
                                            <button style="width: 100%; background: #fef2f2; color: #dc2626; padding: 0.6rem; border-radius: 0.5rem; border: none;"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="desktop-table">
                        <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
                            <thead>
                                <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                                    <th style="padding: 1.25rem 1rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Véhicule</th>
                                    <th style="padding: 1.25rem 1rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; color: #64748b;">Année</th>
                                    <th style="padding: 1.25rem 1rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; color: #64748b;">Kilométrage</th>
                                    <th style="padding: 1.25rem 1rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; color: #64748b;">Prix (FCFA)</th>
                                    <th style="padding: 1.25rem 1rem; text-align: center; font-size: 0.75rem; text-transform: uppercase; color: #64748b;">Statut</th>
                                    <th style="padding: 1.25rem 1rem; text-align: right; font-size: 0.75rem; text-transform: uppercase; color: #64748b;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cars as $car)
                                    <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'">
                                        <td style="padding: 1rem;">
                                            <div style="display: flex; align-items: center; gap: 1rem;">
                                                @php
                                                    $imagePath = ($car->images && $car->images->count() > 0) ? $car->images->first()->image_path : $car->image;
                                                @endphp
                                                <img src="{{ $imagePath ? asset('storage/' . $imagePath) : 'https://via.placeholder.com/80x60' }}" 
                                                     style="width: 70px; height: 50px; object-fit: cover; border-radius: 0.5rem; border: 1px solid #eee;">
                                                <span style="font-weight: 700; color: #1e293b;">{{ $car->marque }} {{ $car->modele }}</span>
                                            </div>
                                        </td>
                                        <td style="padding: 1rem; color: #64748b;">{{ $car->annee }}</td>
                                        <td style="padding: 1rem; color: #64748b;">{{ number_format($car->kilometrage, 0, ',', ' ') }} km</td>
                                        <td style="padding: 1rem; font-weight: 800; color: #1e40af; font-size: 1.05rem;">
                                            {{ number_format($car->prix, 0, ',', ' ') }} <small>FCFA</small>
                                        </td>
                                        <td style="padding: 1rem; text-align: center;">
                                            @if($car->is_sold)
                                                <span style="background: #fee2e2; color: #ef4444; padding: 0.3rem 0.7rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700;">VENDUE</span>
                                            @else
                                                <span style="background: #dcfce7; color: #16a34a; padding: 0.3rem 0.7rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700;">DISPO</span>
                                            @endif
                                        </td>
                                        <td style="padding: 1rem; text-align: right;">
                                            <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                                <a href="{{ route('admin.cars.edit', $car->id) }}" style="color: #3b82f6; background: #eff6ff; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 0.5rem; text-decoration: none;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if(!$car->is_sold)
                                                <form action="{{ route('admin.cars.markSold', $car->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" style="color: #10b981; background: #ecfdf5; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 0.5rem; border: none; cursor: pointer;">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                @endif
                                                <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Supprimer ce véhicule ?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" style="color: #ef4444; background: #fef2f2; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 0.5rem; border: none; cursor: pointer;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 5rem 2rem;">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" style="width: 120px; opacity: 0.2; margin-bottom: 1.5rem;">
                        <h2 style="color: #64748b; font-weight: 600;">Votre garage est vide</h2>
                        <p style="color: #94a3b8; margin-bottom: 2rem;">Commencez par ajouter votre premier véhicule à vendre.</p>
                        <a href="{{ route('admin.cars.create') }}" style="background: #1e40af; color: white; padding: 0.8rem 2rem; border-radius: 0.5rem; text-decoration: none; font-weight: 700;">Ajouter maintenant</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <style>
        /* Responsive Utilities */
        @media (max-width: 1023px) {
            .desktop-table { display: none; }
            .mobile-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1rem; }
        }
        @media (min-width: 1024px) {
            .mobile-grid { display: none; }
            .desktop-table { display: block; overflow-x: auto; }
        }
    </style>
@endsection