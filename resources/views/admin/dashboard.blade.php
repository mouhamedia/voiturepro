@extends('layouts.admin')

@section('title', 'Tableau de Bord - VoiturePro Admin')

@section('content')
    <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; padding: 2.5rem 1.5rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-size: 2.2rem; font-weight: 900; margin: 0; text-transform: uppercase; letter-spacing: -1px;">Tableau de Bord</h1>
                    <p style="color: #e0e7ff; margin: 0.5rem 0 0 0; opacity: 0.9;">Bienvenue, {{ Auth::user()->name ?? 'Admin' }} ! 👋</p>
                </div>
                <div style="font-size: 3.5rem; opacity: 0.2;">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <section style="padding: 2rem 1rem; margin-top: -2rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
                <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-bottom: 4px solid #64748b;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="color: #64748b; font-size: 0.85rem; text-transform: uppercase; font-weight: 700;">Total Voitures</h3>
                        <i class="fas fa-car" style="color: #64748b; opacity: 0.3;"></i>
                    </div>
                    <p style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin: 0.5rem 0 0 0;">{{ $totalCars ?? 0 }}</p>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-bottom: 4px solid #22c55e;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="color: #16a34a; font-size: 0.85rem; text-transform: uppercase; font-weight: 700;">Disponibles</h3>
                        <i class="fas fa-check-circle" style="color: #22c55e; opacity: 0.3;"></i>
                    </div>
                    <p style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin: 0.5rem 0 0 0;">{{ $carsInStock ?? 0 }}</p>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-bottom: 4px solid #3b82f6;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="color: #2563eb; font-size: 0.85rem; text-transform: uppercase; font-weight: 700;">Vendues</h3>
                        <i class="fas fa-shopping-cart" style="color: #3b82f6; opacity: 0.3;"></i>
                    </div>
                    <p style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin: 0.5rem 0 0 0;">{{ $totalSold ?? 0 }}</p>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-bottom: 4px solid #f59e0b;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="color: #d97706; font-size: 0.85rem; text-transform: uppercase; font-weight: 700;">Chiffre d'Affaires</h3>
                        <i class="fas fa-wallet" style="color: #f59e0b; opacity: 0.3;"></i>
                    </div>
                    <p style="font-size: 1.8rem; font-weight: 800; color: #1e293b; margin: 0.5rem 0 0 0;">
                        {{ number_format($totalSales ?? 0, 0, ',', ' ') }} <small style="font-size: 0.9rem;">FCFA</small>
                    </p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr; gap: 2rem; @media (min-width: 1024px) { grid-template-columns: 2fr 1fr; }">
                
                <div>
                    <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 2rem;">
                        <h2 style="font-size: 1.1rem; font-weight: 800; margin: 0 0 1.25rem 0; color: #1e293b; display: flex; align-items: center;">
                            <i class="fas fa-bolt" style="margin-right: 0.75rem; color: #f59e0b;"></i> ACTIONS RAPIDES
                        </h2>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
                            <a href="{{ route('admin.cars.create') }}" style="background: #1e293b; color: white; padding: 0.8rem; border-radius: 0.5rem; text-align: center; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                                <i class="fas fa-plus"></i> Nouvelle Voiture
                            </a>
                            <a href="{{ route('admin.cars.index') }}" style="background: #eff6ff; color: #1e40af; padding: 0.8rem; border-radius: 0.5rem; text-align: center; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                                <i class="fas fa-list"></i> Inventaire
                            </a>
                            <a href="{{ route('admin.sales.index') }}" style="background: #f0fdf4; color: #16a34a; padding: 0.8rem; border-radius: 0.5rem; text-align: center; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                                <i class="fas fa-history"></i> Historique
                            </a>
                        </div>
                    </div>

                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
                        <div style="padding: 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                            <h2 style="font-size: 1.1rem; font-weight: 800; margin: 0; color: #1e293b;">📊 DERNIÈRES VENTES</h2>
                            <a href="{{ route('admin.sales.index') }}" style="font-size: 0.8rem; font-weight: 700; color: #3b82f6; text-decoration: none;">Tout voir</a>
                        </div>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: #f8fafc;">
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; color: #64748b;">VÉHICULE</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; color: #64748b;">CLIENT</th>
                                        <th style="padding: 1rem; text-align: left; font-size: 0.75rem; color: #64748b;">PRIX</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentSales as $sale)
                                        <tr style="border-bottom: 1px solid #f1f5f9;">
                                            <td style="padding: 1rem; font-weight: 700; color: #1e293b; font-size: 0.9rem;">
                                                {{ $sale->car->marque ?? 'N/A' }} {{ $sale->car->modele ?? '' }}
                                            </td>
                                            <td style="padding: 1rem; font-size: 0.85rem; color: #475569;">
                                                {{ $sale->client_nom }}<br>
                                                <small style="color: #94a3b8;">{{ $sale->client_telephone }}</small>
                                            </td>
                                            <td style="padding: 1rem; font-weight: 800; color: #16a34a; font-size: 0.9rem;">
                                                {{ number_format($sale->prix_vente, 0, ',', ' ') }} <small>FCFA</small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" style="padding: 2rem; text-align: center; color: #94a3b8;">Aucune vente enregistrée.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div>
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
                        <div style="padding: 1.5rem; border-bottom: 1px solid #f1f5f9;">
                            <h2 style="font-size: 1.1rem; font-weight: 800; margin: 0; color: #1e293b;">🆕 AJOUTS RÉCENTS</h2>
                        </div>
                        <div style="padding: 1rem;">
                            @foreach($recent_cars as $car)
                                <div style="display: flex; align-items: center; gap: 1rem; padding: 0.75rem; border-radius: 0.75rem; transition: background 0.2s; margin-bottom: 0.5rem;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                    <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                        @if($car->images && $car->images->count() > 0)
                                            <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="fas fa-car" style="color: #cbd5e1;"></i>
                                        @endif
                                    </div>
                                    <div style="flex: 1;">
                                        <p style="margin: 0; font-size: 0.9rem; font-weight: 700; color: #1e293b;">{{ $car->marque }} {{ $car->modele }}</p>
                                        <p style="margin: 0; font-size: 0.8rem; color: #64748b;">{{ number_format($car->prix, 0, ',', ' ') }} FCFA</p>
                                    </div>
                                    <a href="{{ route('admin.cars.edit', $car->id) }}" style="color: #3b82f6; font-size: 0.8rem;"><i class="fas fa-edit"></i></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <a href="/" target="_blank" style="display: block; margin-top: 1.5rem; background: #f8fafc; border: 2px dashed #e2e8f0; padding: 1rem; border-radius: 1rem; text-align: center; text-decoration: none; color: #64748b; font-weight: 700; font-size: 0.85rem;">
                        <i class="fas fa-external-link-alt" style="margin-right: 0.5rem;"></i> VOIR LE SITE PUBLIC
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection