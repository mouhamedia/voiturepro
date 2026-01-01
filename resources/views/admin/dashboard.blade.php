@extends('layouts.admin')

@section('title', 'Dashboard Admin - VoiturePro')

@section('content')
    <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; padding: 2rem 1rem; @media (min-width: 768px) { padding: 3rem 1.5rem; }">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-size: 2rem; @media (min-width: 768px) { font-size: 2.5rem; } font-weight: 900; margin: 0 0 0.5rem 0; text-transform: uppercase;">Tableau de Bord</h1>
                    <p style="color: #e0e7ff; font-style: italic; margin: 0;">Bienvenue, {{ Auth::user()->name ?? 'Admin' }} ! 👋</p>
                </div>
                <div style="font-size: 3rem; opacity: 0.15;">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </div>

    <section style="padding: 1.5rem; @media (min-width: 768px) { padding: 2rem 1.5rem; }">
        <div style="max-width: 1200px; margin: 0 auto;">
            <!-- Stats Cards -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 2rem; @media (min-width: 640px) { grid-template-columns: repeat(2, 1fr); } @media (min-width: 1024px) { grid-template-columns: repeat(4, 1fr); }">
                <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border-top: 4px solid #F53003;">
                    <h3 style="color: #999; font-size: 0.85rem; margin: 0 0 0.5rem 0; font-weight: 600;">Total Voitures</h3>
                    <p style="font-size: 2rem; font-weight: 700; color: #F53003; margin: 0;">{{ $totalCars ?? 0 }}</p>
                </div>
                <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border-top: 4px solid #27AE60;">
                    <h3 style="color: #999; font-size: 0.85rem; margin: 0 0 0.5rem 0; font-weight: 600;">Disponibles</h3>
                    <p style="font-size: 2rem; font-weight: 700; color: #27AE60; margin: 0;">{{ $carsInStock ?? 0 }}</p>
                </div>
                <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border-top: 4px solid #3b82f6;">
                    <h3 style="color: #999; font-size: 0.85rem; margin: 0 0 0.5rem 0; font-weight: 600;">Vendues</h3>
                    <p style="font-size: 2rem; font-weight: 700; color: #3b82f6; margin: 0;">{{ $totalSold ?? 0 }}</p>
                </div>
                <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border-top: 4px solid #a855f7;">
                    <h3 style="color: #999; font-size: 0.85rem; margin: 0 0 0.5rem 0; font-weight: 600;">Chiffre d'Affaires</h3>
                    <p style="font-size: 2rem; font-weight: 700; color: #a855f7; margin: 0;">@xof($totalSales ?? 0)</p>
                </div>
            </div>

            <!-- Actions -->
            <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); margin-bottom: 2rem;">
                <h2 style="font-size: 1.25rem; font-weight: 700; margin: 0 0 1rem 0; color: #1b1b18;">Actions Rapides</h2>
                <div style="display: grid; grid-template-columns: 1fr; gap: 0.75rem; @media (min-width: 640px) { grid-template-columns: repeat(2, 1fr); } @media (min-width: 1024px) { grid-template-columns: repeat(4, 1fr); gap: 1rem; }">
                    <a href="{{ route('admin.cars.create') }}" style="background: linear-gradient(135deg, #F53003, #ff6b35); color: white; padding: 1rem; border-radius: 0.375rem; text-align: center; text-decoration: none; font-weight: 600; transition: all 0.3s ease; display: block;">
                        <i class="fas fa-plus" style="margin-right: 0.5rem;"></i> Ajouter Voiture
                    </a>
                    <a href="{{ route('admin.cars.index') }}" style="background: linear-gradient(135deg, #F53003, #ff6b35); color: white; padding: 1rem; border-radius: 0.375rem; text-align: center; text-decoration: none; font-weight: 600; transition: all 0.3s ease; display: block;">
                        <i class="fas fa-list" style="margin-right: 0.5rem;"></i> Gérer Voitures
                    </a>
                    <a href="{{ route('admin.sales.index') }}" style="background: linear-gradient(135deg, #F53003, #ff6b35); color: white; padding: 1rem; border-radius: 0.375rem; text-align: center; text-decoration: none; font-weight: 600; transition: all 0.3s ease; display: block;">
                        <i class="fas fa-chart-bar" style="margin-right: 0.5rem;"></i> Voir Ventes
                    </a>
                    <a href="/" style="background-color: #e0e0e0; color: #1b1b18; padding: 1rem; border-radius: 0.375rem; text-align: center; text-decoration: none; font-weight: 600; transition: all 0.3s ease; display: block;">
                        <i class="fas fa-home" style="margin-right: 0.5rem;"></i> Retour au Site
                    </a>
                </div>
            </div>

            <!-- Recent Cars -->
            @if($recent_cars && $recent_cars->count() > 0)
                <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); margin-bottom: 2rem; overflow-x: auto;">
                    <h2 style="font-size: 1.25rem; font-weight: 700; margin: 0 0 1rem 0; color: #1b1b18;">Voitures Récentes</h2>
                    
                    <!-- Mobile Cards -->
                    <div style="display: block; @media (min-width: 1024px) { display: none; }">
                        @foreach($recent_cars as $car)
                            <div style="background: #f9f9f8; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border-left: 4px solid #F53003;">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                                    <div>
                                        <p style="font-weight: 700; color: #1b1b18; margin: 0; font-size: 1rem;">{{ $car->marque }} {{ $car->modele }}</p>
                                        <p style="color: #999; margin: 0.25rem 0 0 0; font-size: 0.9rem;">Année: {{ $car->annee ?? '2024' }}</p>
                                    </div>
                                    @if($car->is_sold)
                                        <span style="background: #fee2e2; color: #F53003; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600; white-space: nowrap;">Vendue</span>
                                    @else
                                        <span style="background: #dcfce7; color: #27AE60; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600; white-space: nowrap;">Disponible</span>
                                    @endif
                                </div>
                                <p style="color: #F53003; font-weight: 700; margin: 0.5rem 0; font-size: 1rem;">@xof($car->prix)</p>
                                <div style="display: flex; gap: 0.5rem; margin-top: 0.75rem;">
                                    <a href="{{ route('admin.cars.edit', $car->id) }}" style="flex: 1; background: #F53003; color: white; padding: 0.5rem; border-radius: 0.375rem; text-align: center; text-decoration: none; font-weight: 600; font-size: 0.85rem;">Éditer</a>
                                    <a href="{{ route('cars.show', $car->id) }}" target="_blank" style="flex: 1; background: #3b82f6; color: white; padding: 0.5rem; border-radius: 0.375rem; text-align: center; text-decoration: none; font-weight: 600; font-size: 0.85rem;">Voir</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop Table -->
                    <div style="display: none; @media (min-width: 1024px) { display: block; }">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 2px solid #e3e3e0;">
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #1b1b18;">Marque</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #1b1b18;">Modèle</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #1b1b18;">Prix</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #1b1b18;">Status</th>
                                    <th style="text-align: center; padding: 1rem; font-weight: 700; color: #1b1b18;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_cars as $car)
                                    <tr style="border-bottom: 1px solid #e3e3e0;">
                                        <td style="padding: 1rem;">{{ $car->marque }}</td>
                                        <td style="padding: 1rem;">{{ $car->modele }}</td>
                                        <td style="padding: 1rem; font-weight: 700; color: #F53003;">@xof($car->prix)</td>
                                        <td style="padding: 1rem;">
                                            @if($car->is_sold)
                                                <span style="background: #fee2e2; color: #F53003; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.85rem; font-weight: 600;">Vendue</span>
                                            @else
                                                <span style="background: #dcfce7; color: #27AE60; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.85rem; font-weight: 600;">Disponible</span>
                                            @endif
                                        </td>
                                        <td style="padding: 1rem; text-align: center;">
                                            <a href="{{ route('admin.cars.edit', $car->id) }}" style="color: #F53003; text-decoration: none; font-weight: 600; margin: 0 0.5rem;">Éditer</a>
                                            <a href="{{ route('cars.show', $car->id) }}" target="_blank" style="color: #3b82f6; text-decoration: none; font-weight: 600; margin: 0 0.5rem;">Voir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Voitures Vendues Récentes -->
            @if($soldCars && $soldCars->count() > 0)
                <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); margin-bottom: 2rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 700; margin: 0 0 1rem 0; color: #27AE60;">🎉 Voitures Vendues Récemment</h2>
                    
                    <!-- Mobile Cards -->
                    <div style="display: block; @media (min-width: 1024px) { display: none; }">
                        @foreach($soldCars as $car)
                            <div style="background: #f0fdf4; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border-left: 4px solid #27AE60;">
                                <p style="font-weight: 700; color: #27AE60; margin: 0; font-size: 1rem;">{{ $car->marque }} {{ $car->modele }}</p>
                                <p style="color: #999; margin: 0.5rem 0; font-size: 0.9rem;">Année: {{ $car->annee }} | @xof($car->prix)</p>
                                <p style="color: #666; margin: 0; font-size: 0.85rem;">{{ $car->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop Table -->
                    <div style="display: none; @media (min-width: 1024px) { display: block; overflow-x: auto; }">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 2px solid #e3e3e0; background: #f0fdf4;">
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #27AE60;">Marque & Modèle</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #27AE60;">Année</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #27AE60;">Prix</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #27AE60;">Date de Vente</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($soldCars as $car)
                                    <tr style="border-bottom: 1px solid #e3e3e0;">
                                        <td style="padding: 1rem; font-weight: 600;">{{ $car->marque }} {{ $car->modele }}</td>
                                        <td style="padding: 1rem;">{{ $car->annee }}</td>
                                        <td style="padding: 1rem; font-weight: 700; color: #27AE60;">@xof($car->prix)</td>
                                        <td style="padding: 1rem;">{{ $car->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div style="background: #f0fdf4; padding: 1.5rem; border-radius: 0.75rem; border-left: 4px solid #27AE60; margin-bottom: 2rem;">
                    <p style="color: #27AE60; font-weight: 600; margin: 0;">✓ Aucune vente récente enregistrée pour le moment</p>
                </div>
            @endif

            <!-- Ventes Récentes (Table) -->
            @if($recentSales && $recentSales->count() > 0)
                <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); margin-bottom: 2rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 700; margin: 0 0 1rem 0; color: #1b1b18;">📊 Dernières Ventes</h2>
                    
                    <!-- Mobile Cards -->
                    <div style="display: block; @media (min-width: 1024px) { display: none; }">
                        @foreach($recentSales as $sale)
                            <div style="background: #f3f4f6; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border-left: 4px solid #3b82f6;">
                                <div style="font-weight: 700; color: #1b1b18; margin-bottom: 0.5rem;">
                                    @if($sale->car)
                                        {{ $sale->car->marque }} {{ $sale->car->modele }}
                                    @else
                                        <span style="color: #999;">Véhicule supprimé</span>
                                    @endif
                                </div>
                                <p style="color: #666; margin: 0.5rem 0; font-size: 0.9rem;">
                                    <strong>{{ $sale->client_nom }}</strong><br>
                                    <small style="color: #999;">{{ $sale->client_telephone }}</small>
                                </p>
                                <p style="color: #F53003; font-weight: 700; margin: 0.5rem 0; font-size: 1rem;">@xof($sale->prix_vente)</p>
                                <p style="color: #999; margin: 0; font-size: 0.85rem;">{{ $sale->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop Table -->
                    <div style="display: none; @media (min-width: 1024px) { display: block; overflow-x: auto; }">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 2px solid #e3e3e0; background: #f3f4f6;">
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #1b1b18;">Véhicule</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #1b1b18;">Client</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #1b1b18;">Prix Vente</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 700; color: #1b1b18;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                    <tr style="border-bottom: 1px solid #e3e3e0;">
                                        <td style="padding: 1rem;">
                                            @if($sale->car)
                                                <strong>{{ $sale->car->marque }} {{ $sale->car->modele }}</strong>
                                            @else
                                                <strong style="color: #999;">Véhicule supprimé</strong>
                                            @endif
                                        </td>
                                        <td style="padding: 1rem;">
                                            <strong>{{ $sale->client_nom }}</strong><br>
                                            <small style="color: #999;">{{ $sale->client_telephone }}</small>
                                        </td>
                                        <td style="padding: 1rem; font-weight: 700; color: #F53003;">@xof($sale->prix_vente)</td>
                                        <td style="padding: 1rem; color: #999;">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection