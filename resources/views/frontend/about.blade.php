@extends('layouts.main')

@section('content')

<section style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); padding: 4rem 1rem; text-align: center; color: white; margin-top: 0;">
    <div style="max-width: 1280px; margin: 0 auto;">
        <h1 style="font-size: 2.25rem; font-weight: 900; margin: 0 0 1rem 0; letter-spacing: -0.02em;">
            À Propos de VoiturePro
        </h1>
        <p style="font-size: 1.125rem; margin: 0; color: rgba(255, 255, 255, 0.9); max-width: 600px; margin-left: auto; margin-right: auto;">
            Depuis 2010, nous révolutionnons le marché automobile avec excellence et intégrité
        </p>
    </div>
</section>

<section style="padding: 4rem 1rem; background: #f9f9f8;">
    <div style="max-width: 1280px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div style="background: white; padding: 2.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border-top: 4px solid #F53003;">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #F53003, #ff6b35); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white;">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #1b1b18; margin-bottom: 1rem; text-align: center;">Notre Mission</h3>
                <p style="color: #706f6c; line-height: 1.8; text-align: center;">
                    Rendre l'achat de voiture transparent, honnête et satisfaisant en offrant des véhicules de qualité à des prix justes.
                </p>
            </div>

            <div style="background: white; padding: 2.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border-top: 4px solid #3b82f6;">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #3b82f6, #60a5fa); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white;">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #1b1b18; margin-bottom: 1rem; text-align: center;">Notre Vision</h3>
                <p style="color: #706f6c; line-height: 1.8; text-align: center;">
                    Être le partenaire automobile de confiance, reconnu pour l'intégrité et l'engagement envers la satisfaction clientèle.
                </p>
            </div>

            <div style="background: white; padding: 2.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border-top: 4px solid #a855f7;">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #a855f7, #d946ef); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white;">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #1b1b18; margin-bottom: 1rem; text-align: center;">Nos Valeurs</h3>
                <p style="color: #706f6c; line-height: 1.8; text-align: center;">
                    Intégrité, transparence, excellence et respect du client guident chaque décision que nous prenons.
                </p>
            </div>
        </div>
    </div>
</section>

<section style="padding: 4rem 1rem; background: linear-gradient(135deg, #1b1b18 0%, #2a2a26 100%); color: white;">
    <div style="max-width: 1280px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; text-align: center;">
        <div>
            <div style="font-size: 2.5rem; font-weight: 700; color: #F53003;">50K+</div>
            <p style="color: rgba(255,255,255,0.7);">Clients Satisfaits</p>
        </div>
        <div>
            <div style="font-size: 2.5rem; font-weight: 700; color: #F53003;">4.8 ⭐</div>
            <p style="color: rgba(255,255,255,0.7);">Note Clients</p>
        </div>
        <div>
            <div style="font-size: 2.5rem; font-weight: 700; color: #F53003;">100%</div>
            <p style="color: rgba(255,255,255,0.7);">Qualité Garantie</p>
        </div>
        <div>
            <div style="font-size: 2.5rem; font-weight: 700; color: #F53003;">15+</div>
            <p style="color: rgba(255,255,255,0.7);">Ans d'Expérience</p>
        </div>
    </div>
</section>

<section style="padding: 4rem 1rem; background: white;">
    <div style="max-width: 1280px; margin: 0 auto;">
        <h2 style="font-size: 2rem; font-weight: 900; text-align: center; margin-bottom: 3rem;">Notre Équipe d'Experts</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
            <div style="background: #f8fafc; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div style="background: linear-gradient(135deg, #1e40af, #3b82f6); height: 150px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-circle" style="font-size: 4rem; color: white;"></i>
                </div>
                <div style="padding: 1.5rem; text-align: center;">
                    <h3 style="font-size: 1.25rem; font-weight: 900; margin-bottom: 0.25rem;">Ahmed Diallo</h3>
                    <p style="color: #F53003; font-weight: 700; text-transform: uppercase; font-size: 0.8rem;">Directeur Général</p>
                </div>
            </div>
            <div style="background: #f8fafc; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div style="background: linear-gradient(135deg, #3b82f6, #60a5fa); height: 150px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-circle" style="font-size: 4rem; color: white;"></i>
                </div>
                <div style="padding: 1.5rem; text-align: center;">
                    <h3 style="font-size: 1.25rem; font-weight: 900; margin-bottom: 0.25rem;">Fatou Sané</h3>
                    <p style="color: #3b82f6; font-weight: 700; text-transform: uppercase; font-size: 0.8rem;">Dir. Commerciale</p>
                </div>
            </div>
            <div style="background: #f8fafc; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div style="background: linear-gradient(135deg, #a855f7, #d946ef); height: 150px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-circle" style="font-size: 4rem; color: white;"></i>
                </div>
                <div style="padding: 1.5rem; text-align: center;">
                    <h3 style="font-size: 1.25rem; font-weight: 900; margin-bottom: 0.25rem;">Mamadou Ba</h3>
                    <p style="color: #a855f7; font-weight: 700; text-transform: uppercase; font-size: 0.8rem;">Dir. Technique</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: linear-gradient(135deg, #F53003 0%, #ff6b35 100%); color: white; text-align: center; padding: 4rem 1.5rem;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.25rem; font-weight: 900; margin-bottom: 1.5rem;">Prêt à trouver votre véhicule ?</h2>
        <p style="font-size: 1.125rem; margin-bottom: 2.5rem; opacity: 0.9;">
            Rejoignez les milliers de clients satisfaits qui font confiance à l'expertise de VoiturePro.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('cars.index') }}" style="background: white; color: #F53003; padding: 1rem 2rem; border-radius: 0.5rem; font-weight: 900; text-decoration: none; text-transform: uppercase;">
                Voir le Catalogue
            </a>
            <a href="/contact" style="background: transparent; color: white; padding: 1rem 2rem; border: 2px solid white; border-radius: 0.5rem; font-weight: 900; text-decoration: none; text-transform: uppercase;">
                Nous Contacter
            </a>
        </div>
    </div>
</section>

@endsection