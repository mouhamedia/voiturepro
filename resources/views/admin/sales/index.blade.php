@extends('layouts.admin')

@section('title', 'Historique des Ventes - VoiturePro')

@section('content')
<div style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; padding: 2.5rem 1rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 style="font-size: 2.2rem; font-weight: 900; margin: 0; text-transform: uppercase; letter-spacing: -0.5px;">Historique des Ventes</h1>
                <p style="color: #bfdbfe; margin: 0.5rem 0 0 0; font-weight: 500;">Suivi financier et administratif des transactions</p>
            </div>
            <div style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 50%; width: 70px; height: 70px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-file-invoice-dollar" style="font-size: 2rem;"></i>
            </div>
        </div>
    </div>
</div>

<div style="padding: 2rem 1rem; margin-top: -2.5rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div style="background: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); padding: 1.5rem; border-top: 4px solid #8b5cf6;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="background: #f5f3ff; color: #8b5cf6; width: 45px; height: 45px; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <span style="color: #6b7280; font-size: 0.875rem; font-weight: 700; text-transform: uppercase;">Total Chiffre d'Affaires</span>
                </div>
                <p style="font-size: 2.25rem; font-weight: 900; color: #1e293b; margin: 0;">
                    {{ number_format($sales->sum('prix_vente') ?? 0, 0, ',', ' ') }} <small style="font-size: 1rem; color: #6b7280;">FCFA</small>
                </p>
            </div>
            
            <div style="background: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); padding: 1.5rem; border-top: 4px solid #10b981;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="background: #ecfdf5; color: #10b981; width: 45px; height: 45px; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <span style="color: #6b7280; font-size: 0.875rem; font-weight: 700; text-transform: uppercase;">Volume de Ventes</span>
                </div>
                <p style="font-size: 2.25rem; font-weight: 900; color: #1e293b; margin: 0;">{{ $sales->count() }} <small style="font-size: 1rem; color: #6b7280;">véhicules</small></p>
            </div>
        </div>

        <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden;">
            
            <div style="display: block; @media (min-width: 1024px) { display: none; } padding: 1rem;">
                @forelse($sales as $sale)
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 1.25rem; border-radius: 1rem; margin-bottom: 1rem; position: relative;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <div>
                                <h4 style="margin: 0; color: #1e293b; font-size: 1.1rem; font-weight: 800;">{{ $sale->car->marque ?? 'N/A' }}</h4>
                                <p style="margin: 0; color: #64748b; font-size: 0.9rem;">{{ $sale->car->modele ?? 'Modèle inconnu' }}</p>
                            </div>
                            <span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.6rem; border-radius: 2rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">Confirmée</span>
                        </div>
                        <div style="border-top: 1px dashed #cbd5e1; padding-top: 0.75rem; margin-bottom: 0.75rem;">
                            <p style="margin: 0; font-size: 0.85rem; color: #475569;"><strong>Client:</strong> {{ $sale->client_nom }}</p>
                            <p style="margin: 0; font-size: 0.85rem; color: #475569;"><strong>Date:</strong> {{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y') }}</p>
                        </div>
                        <div style="font-size: 1.25rem; font-weight: 900; color: #2563eb;">
                            {{ number_format($sale->prix_vente, 0, ',', ' ') }} <small style="font-size: 0.75rem;">FCFA</small>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 3rem;">
                        <p style="color: #94a3b8;">Aucune donnée disponible</p>
                    </div>
                @endforelse
            </div>

            <div style="display: none; @media (min-width: 1024px) { display: block; overflow-x: auto; }">
                <table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                            <th style="padding: 1.25rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Détails Véhicule</th>
                            <th style="padding: 1.25rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Client & Contact</th>
                            <th style="padding: 1.25rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Montant Transaction</th>
                            <th style="padding: 1.25rem 1.5rem; text-align: center; font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9'" onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 1.25rem 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div style="background: #eff6ff; color: #3b82f6; width: 40px; height: 40px; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-car-side"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #1e293b;">{{ $sale->car->marque ?? 'Supprimé' }}</div>
                                        <div style="font-size: 0.8rem; color: #94a3b8;">{{ $sale->car->modele ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1.25rem 1.5rem;">
                                <div style="font-weight: 600; color: #334155;">{{ $sale->client_nom ?? 'Vente Directe' }}</div>
                                <div style="font-size: 0.8rem; color: #64748b;">
                                    <i class="fas fa-phone-alt" style="font-size: 0.7rem;"></i> {{ $sale->client_contact ?? $sale->client_telephone ?? '--' }}
                                </div>
                            </td>
                            <td style="padding: 1.25rem 1.5rem;">
                                <div style="font-weight: 800; color: #1e3a8a; font-size: 1.1rem;">
                                    {{ number_format($sale->prix_vente, 0, ',', ' ') }} FCFA
                                </div>
                                <div style="font-size: 0.75rem; color: #94a3b8;">
                                    <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y à H:i') }}
                                </div>
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: center;">
                                <span style="background: #dcfce7; color: #166534; padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700;">
                                    PAYÉ
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 4rem 1.5rem; text-align: center;">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" style="width: 80px; opacity: 0.2; margin-bottom: 1rem;">
                                <p style="color: #94a3b8; font-weight: 600; margin: 0;">Aucun enregistrement trouvé dans l'historique.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $sales->links() }}
        </div>
    </div>
</div>
@endsection