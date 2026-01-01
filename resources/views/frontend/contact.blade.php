@extends('layouts.main')

@section('title', 'Nous Contacter - VoiturePro')
@section('description', 'Contactez notre équipe pour vos questions ou demandes de renseignements')

@section('content')
    <!-- Page Header -->
    <section style="background: linear-gradient(135deg, #F53003 0%, #ff6b35 100%); color: white; padding: 3rem 1.5rem;">
        <div class="container">
            <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1rem; animation: slideUp 0.8s ease-out;">
                Nous Contacter
            </h1>
            <p style="font-size: 1.25rem; opacity: 0.95; animation: slideUp 0.8s ease-out 0.2s both;">
                Notre équipe est prête à vous aider 24/7
            </p>
        </div>
    </section>

    <!-- Contact Options -->
    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
                <!-- Phone -->
                <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); text-align: center; animation: slideUp 0.8s ease-out;">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #F53003, #ff6b35); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white;">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem;">Téléphone</h3>
                    <p style="color: #706f6c; margin-bottom: 1rem;">Appelez-nous gratuitement</p>
                    <a href="tel:+33123456789" style="font-size: 1.1rem; font-weight: 700; color: #F53003; text-decoration: none;">
                        +33 (0)1 23 45 67 89
                    </a>
                    <p style="color: #999; font-size: 0.9rem; margin-top: 1rem;">Ouvert 24/7</p>
                </div>

                <!-- Email -->
                <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); text-align: center; animation: slideUp 0.8s ease-out 0.1s both;">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #3b82f6, #60a5fa); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem;">Email</h3>
                    <p style="color: #706f6c; margin-bottom: 1rem;">Écrivez-nous directement</p>
                    <a href="mailto:contact@voiturepro.fr" style="font-size: 1.1rem; font-weight: 700; color: #3b82f6; text-decoration: none;">
                        contact@voiturepro.fr
                    </a>
                    <p style="color: #999; font-size: 0.9rem; margin-top: 1rem;">Réponse en 2 heures</p>
                </div>

                <!-- Chat -->
                <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); text-align: center; animation: slideUp 0.8s ease-out 0.2s both;">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #a855f7, #d946ef); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white;">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem;">Chat En Direct</h3>
                    <p style="color: #706f6c; margin-bottom: 1rem;">Discutez avec notre équipe</p>
                    <button onclick="openChat()" style="font-size: 1.1rem; font-weight: 700; color: #a855f7; background: none; border: none; cursor: pointer; text-decoration: none;">
                        Ouvrir le Chat
                    </button>
                    <p style="color: #999; font-size: 0.9rem; margin-top: 1rem;">Lun-Ven: 8h-20h</p>
                </div>

                <!-- WhatsApp -->
                <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); text-align: center; animation: slideUp 0.8s ease-out 0.3s both;">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #25D366, #20BA57); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white;">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem;">WhatsApp</h3>
                    <p style="color: #706f6c; margin-bottom: 1rem;">Messagerie instantanée</p>
                    <a href="https://wa.me/33123456789?text=Bonjour%20VoiturePro%2C%20je%20souhaite%20plus%20d%27informations" target="_blank" style="font-size: 1.1rem; font-weight: 700; color: #25D366; text-decoration: none; display: inline-block;">
                        <i class="fab fa-whatsapp" style="margin-right: 0.5rem;"></i> Nous Écrire
                    </a>
                    <p style="color: #999; font-size: 0.9rem; margin-top: 1rem;">Réponse immédiate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="section" style="background: #f9f9f8;">
        <div class="container" style="max-width: 700px;">
            <div style="text-align: center; margin-bottom: 3rem;">
                <h2 class="section-title" style="animation: slideUp 0.8s ease-out;">Envoyez-nous un Message</h2>
                <p style="color: #706f6c; font-size: 1rem; margin-top: 1rem;">Remplissez le formulaire ci-dessous et nous vous répondrons rapidement</p>
            </div>

            <form method="POST" action="#" style="background: white; padding: 2.5rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out 0.1s both;">
                @csrf

                <!-- Name -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 700; color: #1b1b18;">Nom Complet *</label>
                    <input 
                        type="text" 
                        name="name" 
                        required
                        placeholder="Votre nom complet"
                        style="width: 100%; padding: 0.875rem; border: 1px solid #e3e3e0; border-radius: 0.375rem; font-size: 1rem; font-family: inherit; transition: border-color 0.3s ease;"
                        onfocus="this.style.borderColor='#F53003'"
                        onblur="this.style.borderColor='#e3e3e0'"
                    >
                </div>

                <!-- Email -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 700; color: #1b1b18;">Email *</label>
                    <input 
                        type="email" 
                        name="email" 
                        required
                        placeholder="votre.email@exemple.com"
                        style="width: 100%; padding: 0.875rem; border: 1px solid #e3e3e0; border-radius: 0.375rem; font-size: 1rem; font-family: inherit; transition: border-color 0.3s ease;"
                        onfocus="this.style.borderColor='#F53003'"
                        onblur="this.style.borderColor='#e3e3e0'"
                    >
                </div>

                <!-- Phone -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 700; color: #1b1b18;">Téléphone</label>
                    <input 
                        type="tel" 
                        name="phone" 
                        placeholder="06 12 34 56 78"
                        style="width: 100%; padding: 0.875rem; border: 1px solid #e3e3e0; border-radius: 0.375rem; font-size: 1rem; font-family: inherit; transition: border-color 0.3s ease;"
                        onfocus="this.style.borderColor='#F53003'"
                        onblur="this.style.borderColor='#e3e3e0'"
                    >
                </div>

                <!-- Subject -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 700; color: #1b1b18;">Sujet *</label>
                    <select 
                        name="subject" 
                        required
                        style="width: 100%; padding: 0.875rem; border: 1px solid #e3e3e0; border-radius: 0.375rem; font-size: 1rem; font-family: inherit; transition: border-color 0.3s ease;"
                        onfocus="this.style.borderColor='#F53003'"
                        onblur="this.style.borderColor='#e3e3e0'"
                    >
                        <option value="">-- Sélectionnez un sujet --</option>
                        <option value="general">Question Générale</option>
                        <option value="purchase">Aide pour l'Achat</option>
                        <option value="financing">Financement</option>
                        <option value="delivery">Livraison</option>
                        <option value="trade-in">Reprise d'Ancien Véhicule</option>
                        <option value="other">Autre</option>
                    </select>
                </div>

                <!-- Message -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 700; color: #1b1b18;">Message *</label>
                    <textarea 
                        name="message" 
                        required
                        rows="6"
                        placeholder="Décrivez votre demande en détail..."
                        style="width: 100%; padding: 0.875rem; border: 1px solid #e3e3e0; border-radius: 0.375rem; font-size: 1rem; font-family: inherit; resize: vertical; transition: border-color 0.3s ease;"
                        onfocus="this.style.borderColor='#F53003'"
                        onblur="this.style.borderColor='#e3e3e0'"
                    ></textarea>
                </div>

                <!-- Privacy Policy -->
                <div style="margin-bottom: 2rem; padding: 1rem; background: #f5f5f5; border-radius: 0.375rem;">
                    <label style="display: flex; align-items: flex-start; gap: 0.75rem; cursor: pointer;">
                        <input 
                            type="checkbox" 
                            name="privacy" 
                            required
                            style="margin-top: 0.35rem; cursor: pointer;"
                        >
                        <span style="color: #706f6c; font-size: 0.9rem;">
                            J'accepte la politique de confidentialité et j'autorise VoiturePro à me contacter concernant ma demande
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="btn btn-primary" 
                    style="width: 100%; padding: 1rem; font-size: 1.05rem; font-weight: 700;"
                >
                    <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i> Envoyer le Message
                </button>
            </form>

            <!-- Response Time -->
            <div style="text-align: center; margin-top: 2rem; padding: 1.5rem; background: #f0f9ff; border-radius: 0.75rem; border-left: 4px solid #3b82f6;">
                <p style="color: #0c5fb1; font-weight: 600;">
                    <i class="fas fa-clock" style="margin-right: 0.5rem;"></i> 
                    Nous nous engageons à vous répondre dans les 2 heures
                </p>
            </div>
        </div>
    </section>

    <!-- Office Locations -->
    <section class="section">
        <div class="container">
            <div style="text-align: center; margin-bottom: 3rem;">
                <span style="color: #F53003; font-weight: 700; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 2px;">Visites</span>
                <h2 class="section-title" style="margin-top: 0.5rem;">Nos Locaux</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <!-- Paris -->
                <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #F53003; margin-bottom: 1rem;">
                        <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem;"></i> Paris
                    </h3>
                    <p style="color: #706f6c; margin-bottom: 0.5rem;">
                        123 Avenue des Champs
                    </p>
                    <p style="color: #706f6c; margin-bottom: 1.5rem;">
                        75008 Paris, France
                    </p>
                    <p style="color: #706f6c; font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <strong>Téléphone:</strong> +33 (0)1 23 45 67 89
                    </p>
                    <p style="color: #706f6c; font-size: 0.9rem; margin-bottom: 1rem;">
                        <strong>Horaires:</strong> Lun-Sam 9h-19h, Dim 10h-18h
                    </p>
                    <a href="#" style="color: #F53003; text-decoration: none; font-weight: 600;">
                        Voir sur la carte <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                </div>

                <!-- Lyon -->
                <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out 0.1s both;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #F53003; margin-bottom: 1rem;">
                        <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem;"></i> Lyon
                    </h3>
                    <p style="color: #706f6c; margin-bottom: 0.5rem;">
                        456 Rue de la Paix
                    </p>
                    <p style="color: #706f6c; margin-bottom: 1.5rem;">
                        69000 Lyon, France
                    </p>
                    <p style="color: #706f6c; font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <strong>Téléphone:</strong> +33 (0)4 78 90 12 34
                    </p>
                    <p style="color: #706f6c; font-size: 0.9rem; margin-bottom: 1rem;">
                        <strong>Horaires:</strong> Lun-Sam 9h-19h, Dim 10h-18h
                    </p>
                    <a href="#" style="color: #F53003; text-decoration: none; font-weight: 600;">
                        Voir sur la carte <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                </div>

                <!-- Marseille -->
                <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out 0.2s both;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #F53003; margin-bottom: 1rem;">
                        <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem;"></i> Marseille
                    </h3>
                    <p style="color: #706f6c; margin-bottom: 0.5rem;">
                        789 Boulevard Longchamp
                    </p>
                    <p style="color: #706f6c; margin-bottom: 1.5rem;">
                        13000 Marseille, France
                    </p>
                    <p style="color: #706f6c; font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <strong>Téléphone:</strong> +33 (0)4 91 56 78 90
                    </p>
                    <p style="color: #706f6c; font-size: 0.9rem; margin-bottom: 1rem;">
                        <strong>Horaires:</strong> Lun-Sam 9h-19h, Dim 10h-18h
                    </p>
                    <a href="#" style="color: #F53003; text-decoration: none; font-weight: 600;">
                        Voir sur la carte <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function openChat() {
            alert('Chat en direct ouvert! (Fonction de démonstration)');
        }
    </script>
@endsection
