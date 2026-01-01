@extends('layouts.main')

@section('title', 'Questions Fréquentes - VoiturePro')
@section('description', 'Réponses aux questions fréquemment posées sur nos services')

@section('content')
    <!-- Page Header -->
    <section style="background: linear-gradient(135deg, #F53003 0%, #ff6b35 100%); color: white; padding: 3rem 1.5rem;">
        <div class="container">
            <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1rem; animation: slideUp 0.8s ease-out;">
                Questions Fréquentes
            </h1>
            <p style="font-size: 1.25rem; opacity: 0.95; animation: slideUp 0.8s ease-out 0.2s both;">
                Trouvez les réponses à vos questions les plus courantes
            </p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section">
        <div class="container" style="max-width: 800px;">
            <!-- Question 1 -->
            <div class="faq-item" style="margin-bottom: 1.5rem; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out;">
                <div class="faq-question" style="background: white; padding: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border-left: 4px solid #F53003;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #1b1b18; margin: 0;">
                        <i class="fas fa-question-circle" style="color: #F53003; margin-right: 1rem;"></i> Comment puis-je acheter une voiture?
                    </h3>
                    <i class="fas fa-chevron-down" style="color: #F53003; font-size: 1.2rem; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="background: #f9f9f8; padding: 0; max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <p style="padding: 1.5rem; color: #706f6c; line-height: 1.8;">
                        Le processus est simple: 
                        <br>1. Parcourez notre catalogue
                        <br>2. Sélectionnez une voiture qui vous plaît
                        <br>3. Contactez-nous pour finaliser les détails
                        <br>4. Effectuez le paiement sécurisé
                        <br>5. Livraison gratuite dans toute la France
                    </p>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="faq-item" style="margin-bottom: 1.5rem; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out 0.1s both;">
                <div class="faq-question" style="background: white; padding: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border-left: 4px solid #3b82f6;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #1b1b18; margin: 0;">
                        <i class="fas fa-question-circle" style="color: #3b82f6; margin-right: 1rem;"></i> Quelles garanties offrez-vous?
                    </h3>
                    <i class="fas fa-chevron-down" style="color: #3b82f6; font-size: 1.2rem; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="background: #f9f9f8; padding: 0; max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <p style="padding: 1.5rem; color: #706f6c; line-height: 1.8;">
                        Nous offrons:
                        <br>✓ Garantie 30 jours - Remboursement intégral
                        <br>✓ Inspection mécanique complète
                        <br>✓ Historique maintenance fourni
                        <br>✓ Support client 24/7
                        <br>✓ Assistance juridique gratuite
                    </p>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="faq-item" style="margin-bottom: 1.5rem; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out 0.2s both;">
                <div class="faq-question" style="background: white; padding: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border-left: 4px solid #a855f7;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #1b1b18; margin: 0;">
                        <i class="fas fa-question-circle" style="color: #a855f7; margin-right: 1rem;"></i> Quelle est la durée de livraison?
                    </h3>
                    <i class="fas fa-chevron-down" style="color: #a855f7; font-size: 1.2rem; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="background: #f9f9f8; padding: 0; max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <p style="padding: 1.5rem; color: #706f6c; line-height: 1.8;">
                        La livraison varie selon votre localisation:
                        <br>• Paris et région: 2-3 jours ouvrables
                        <br>• Province: 5-7 jours ouvrables
                        <br>• Livraison gratuite partout en France métropolitaine
                        <br>• Transport assuré de porte à porte
                    </p>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="faq-item" style="margin-bottom: 1.5rem; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out 0.3s both;">
                <div class="faq-question" style="background: white; padding: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border-left: 4px solid #16a34a;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #1b1b18; margin: 0;">
                        <i class="fas fa-question-circle" style="color: #16a34a; margin-right: 1rem;"></i> Proposez-vous un financement?
                    </h3>
                    <i class="fas fa-chevron-down" style="color: #16a34a; font-size: 1.2rem; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="background: #f9f9f8; padding: 0; max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <p style="padding: 1.5rem; color: #706f6c; line-height: 1.8;">
                        Oui! Nous proposons plusieurs options:
                        <br>✓ Financement sur 24/36/48 mois
                        <br>✓ Taux compétitifs à partir de 4.9% APR
                        <br>✓ Sans apport possible
                        <br>✓ Approbation rapide (24h)
                        <br>✓ Partenariat avec plusieurs banques
                    </p>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="faq-item" style="margin-bottom: 1.5rem; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out 0.4s both;">
                <div class="faq-question" style="background: white; padding: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border-left: 4px solid #f97316;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #1b1b18; margin: 0;">
                        <i class="fas fa-question-circle" style="color: #f97316; margin-right: 1rem;"></i> Pouvez-vous reprendre mon ancienne voiture?
                    </h3>
                    <i class="fas fa-chevron-down" style="color: #f97316; font-size: 1.2rem; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="background: #f9f9f8; padding: 0; max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <p style="padding: 1.5rem; color: #706f6c; line-height: 1.8;">
                        Absolument! Nous offrons:
                        <br>✓ Estimation gratuite de votre véhicule
                        <br>✓ Reprise au meilleur prix du marché
                        <br>✓ Déduction directe du prix d'achat
                        <br>✓ Financement du solde possible
                        <br>✓ Pas de frais de transaction
                    </p>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="faq-item" style="margin-bottom: 1.5rem; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); animation: slideUp 0.8s ease-out 0.5s both;">
                <div class="faq-question" style="background: white; padding: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: space-between; transition: all 0.3s ease; border-left: 4px solid #06b6d4;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #1b1b18; margin: 0;">
                        <i class="fas fa-question-circle" style="color: #06b6d4; margin-right: 1rem;"></i> Comment est votre service client?
                    </h3>
                    <i class="fas fa-chevron-down" style="color: #06b6d4; font-size: 1.2rem; transition: transform 0.3s ease;"></i>
                </div>
                <div class="faq-answer" style="background: #f9f9f8; padding: 0; max-height: 0; overflow: hidden; transition: all 0.3s ease;">
                    <p style="padding: 1.5rem; color: #706f6c; line-height: 1.8;">
                        Notre équipe est toujours prête à vous aider:
                        <br>✓ Support téléphonique 24/7
                        <br>✓ Chat en direct pendant les heures de bureau
                        <br>✓ Email support avec réponse en 2 heures
                        <br>✓ Visite virtuelle des véhicules
                        <br>✓ Conseil personnalisé gratuit
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section style="background: linear-gradient(135deg, #F53003 0%, #ff6b35 100%); color: white; text-align: center; padding: 3rem 1.5rem; margin-top: 3rem;">
        <div class="container">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem;">Vous avez d'autres questions?</h2>
            <p style="font-size: 1.1rem; margin-bottom: 2rem; opacity: 0.95;">Notre équipe d'experts est disponible pour vous aider</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="tel:+33123456789" class="btn btn-secondary" style="padding: 1rem 2rem;">
                    <i class="fas fa-phone" style="margin-right: 0.5rem;"></i> Appeler: 01 23 45 67 89
                </a>
                <a href="/cars" class="btn btn-secondary" style="padding: 1rem 2rem;">
                    <i class="fas fa-car" style="margin-right: 0.5rem;"></i> Voir le Catalogue
                </a>
            </div>
        </div>
    </section>

    <!-- JavaScript for FAQ -->
    <script>
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentElement;
                const answer = faqItem.querySelector('.faq-answer');
                const icon = this.querySelector('.fa-chevron-down');
                
                // Close other open FAQs
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== faqItem) {
                        const otherAnswer = item.querySelector('.faq-answer');
                        const otherIcon = item.querySelector('.fa-chevron-down');
                        otherAnswer.style.maxHeight = '0';
                        otherIcon.style.transform = 'rotate(0deg)';
                    }
                });
                
                // Toggle current FAQ
                if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
                    answer.style.maxHeight = '0';
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    </script>

    <style>
        .faq-question {
            cursor: pointer;
        }
        
        .faq-question:hover {
            background: #f5f5f5 !important;
        }
        
        .faq-answer {
            transition: max-height 0.3s ease, padding 0.3s ease;
        }
    </style>
@endsection
