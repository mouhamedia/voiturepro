@extends('layouts.admin')

@section('title', 'Dashboard Admin - VoiturePro')

@section('content')
<style>
    :root { 
        --admin-primary: #1e40af; 
        --admin-accent: #F53003; 
        --admin-success: #27AE60; 
        --admin-bg: #f4f7fe;
    }

    /* Style global pour le tableau de bord */
    .dashboard-wrapper { background-color: var(--admin-bg); min-height: 100vh; padding-bottom: 3rem; }

    .header-gradient { 
        background: linear-gradient(135deg, var(--admin-primary) 0%, #3b82f6 100%); 
        color: white; 
        padding: 4rem 1.5rem; 
        border-radius: 0 0 2.5rem 2.5rem; 
        margin-bottom: -3rem; 
    }

    .stats-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
        gap: 1.5rem; 
        padding: 0 1.5rem; 
        max-width: 1200px;
        margin: 0 auto;
    }

    .stat-card { 
        background: white; 
        padding: 1.5rem; 
        border-radius: 1.25rem; 
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); 
        border-bottom: 4px solid #ddd; 
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    
    .stat-card:hover { transform: translateY(-10px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }

    .stat-icon { font-size: 1.5rem; margin-bottom: 1rem; opacity: 0.8; }

    .action-btn { 
        transition: all 0.3s; 
        text-decoration: none; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 0.7rem; 
        font-weight: 600; 
        padding: 1rem;
        border-radius: 0.75rem;
    }
    
    .action-btn:hover { opacity: 0.9; transform: scale(1.03); color: white; }

    .table-container { 
        background: white; 
        border-radius: 1.25rem; 
        padding: 1.5rem; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
        margin: 2rem 1.5rem;
        overflow-x: auto; 
    }

    table { width: 100%; border-collapse: collapse; min-width: 600px; }
    th { text-align: left; padding: 1.2rem 1rem; color: #888; font-weight: 600; border-bottom: 2px solid #f3f4f6; text-transform: uppercase; font-size: 0.75rem; }
    td { padding: 1.2rem 1rem; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }

    .badge { padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; }
    .badge-success { background: #dcfce7; color: #166534; }
    .badge-danger { background: #fee2e2; color: #991b1b; }

    .car-name { color: #1e293b; font-weight: 700; font-size: 1rem; }
</style>

<div class="dashboard-wrapper">
    <div class="header-gradient">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="margin: 0; font-size: 2.2rem; font-weight: 900; letter-spacing: -1px;">TABLEAU DE BORD</h1>
                <p style="opacity: 0.9; font-size: 1.1rem;">Bienvenue, <strong>{{ Auth::user()->name ?? 'Administrateur' }}</strong> 👋</p>
            </div>
            <div style="background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 1rem;">
                <i class="fas fa-calendar-alt"></i> {{ date('d M Y') }}
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card" style="border-color: var(--admin-accent);">
            <i class="fas fa-car stat-icon" style="color: var(--admin-accent);"></i>
            <small style="color: #666; font-weight: 600;">TOTAL VOITURES</small>
            <div style="font-size: 2.5rem; font-weight: 900; color: var(--admin-accent);">{{ $totalCars ?? 0 }}</div>
        </div>

        <div class="stat-card" style="border-color: var(--admin-success);">
            <i class="fas fa-check-circle stat-icon" style="color: var(--admin-success);"></i>
            <small style="color: #666; font-weight: 600;">EN STOCK</small>
            <div style="font-size: 2.5rem; font-weight: 900; color: var(--admin-success);">{{ $carsInStock ?? 0 }}</div>
        </div>

        <div class="stat-card" style="border-color: #3b82f6;">
            <i class="fas fa-shopping-cart stat-icon" style="color: #3b82f6;"></i>
            <small style="color: #666; font-weight: 600;">VENDUES</small>
            <div style="font-size: 2.5rem; font-weight: 900; color: #3b82f6;">{{ $totalSold ?? 0 }}</div>
        </div>

        <div class="stat-card" style="border-color: #a855f7;">
            <i class="fas fa-wallet stat-icon" style="color: #a855f7;"></i>
            <small style="color: #666; font-weight: 600;">CHIFFRE D'AFFAIRES</small>
            <div style="font-size: 1.8rem; font-weight: 900; color: #a855f7;">@xof($totalSales ?? 0)</div>
        </div>
    </div>

    <div style="max-width: 1200px; margin: 3rem auto 0 auto;">
        <div style="padding: 0 1.5rem;">
            <h3 style="margin-bottom: 1.5rem; color: #1e293b; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-bolt" style="color: #f59e0b;"></i> Actions Rapides
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <a href="{{ route('admin.cars.create') }}" class="action-btn" style="background: var(--admin-accent); color: white;">
                    <i class="fas fa-plus-circle"></i> Ajouter un véhicule
                </a>
                <a href="{{ route('admin.cars.index') }}" class="action-btn" style="background: #1e293b; color: white;">
                    <i class="fas fa-tasks"></i> Gérer le stock
                </a>
                <a href="/" target="_blank" class="action-btn" style="background: white; border: 1px solid #ddd; color: #1e293b;">
                    <i class="fas fa-external-link-alt"></i> Voir la boutique
                </a>
            </div>
        </div>

        <div class="table-container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="margin: 0; color: #1e293b;">📦 Derniers ajouts</h3>
                <a href="{{ route('admin.cars.index') }}" style="color: var(--admin-primary); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Voir tout →</a>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Détails du Véhicule</th>
                        <th>Prix de vente</th>
                        <th>État</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_cars as $car)
                    <tr>
                        <td>
                            <div class="car-name">{{ $car->marque }} {{ $car->modele }}</div>
                            <small style="color: #94a3b8;">Année {{ $car->annee ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <span style="color: var(--admin-accent); font-weight: 800; font-size: 1.1rem;">@xof($car->prix)</span>
                        </td>
                        <td>
                            <span class="badge {{ $car->is_sold ? 'badge-danger' : 'badge-success' }}">
                                <i class="fas {{ $car->is_sold ? 'fa-times-circle' : 'fa-check-circle' }}"></i>
                                {{ $car->is_sold ? 'Vendue' : 'Disponible' }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.cars.edit', $car->id) }}" style="background: #eff6ff; color: #3b82f6; padding: 0.5rem; border-radius: 0.5rem; margin-right: 0.5rem;" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('cars.show', $car->id) }}" target="_blank" style="background: #f8fafc; color: #64748b; padding: 0.5rem; border-radius: 0.5rem;" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 3rem; color: #94a3b8;">
                            <i class="fas fa-box-open" style="font-size: 2rem; display: block; margin-bottom: 1rem;"></i>
                            Aucune voiture enregistrée pour le moment.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection