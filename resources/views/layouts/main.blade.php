<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VoiturePro - Plateforme de Vente de Voitures')</title>
    <meta name="description" content="@yield('description', 'Découvrez notre collection de voitures neuves et d\'occasion de qualité')">
    
    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            color: #1b1b18;
            background-color: #FDFDFC;
            transition: background-color 0.3s ease;
        }
        
        body.dark-mode {
            background-color: #0a0a0a;
            color: #EDEDEC;
        }
        
        /* Navigation Styles */
        nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        body.dark-mode nav {
            background: rgba(10, 10, 10, 0.95);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        }
        
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #F53003;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        .nav-links {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            padding: 1rem;
            gap: 0.5rem;
            border-bottom: 1px solid #e3e3e0;
        }
        
        body.dark-mode .nav-links {
            background: rgba(10, 10, 10, 0.98);
            border-bottom-color: #3E3E3A;
        }
        
        .nav-links.active {
            display: flex;
        }
        
        .nav-link {
            color: #1b1b18;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        
        body.dark-mode .nav-link {
            color: #EDEDEC;
        }
        
        .nav-link:hover {
            background-color: #f0f0f0;
            color: #F53003;
        }
        
        body.dark-mode .nav-link:hover {
            background-color: #1D0002;
            color: #FF4433;
        }
        
        .nav-link.active {
            color: #F53003;
            background-color: #fff2f2;
        }
        
        body.dark-mode .nav-link.active {
            color: #FF4433;
            background-color: #1D0002;
        }
        
        .hamburger {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }
        
        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: #1b1b18;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        body.dark-mode .hamburger span {
            background-color: #EDEDEC;
        }
        
        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }
        
        @media (min-width: 768px) {
            .nav-links {
                display: flex;
                position: static;
                flex-direction: row;
                background: none;
                padding: 0;
                gap: 1.5rem;
                border: none;
            }
            
            .hamburger {
                display: none;
            }
            
            .nav-link {
                padding: 0.5rem 1rem;
            }
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #F53003 0%, #ff6b35 50%, #1b1b18 100%);
            color: white;
            text-align: center;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -200px;
            left: -200px;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -150px;
            right: -150px;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            padding: 2rem;
            animation: slideUp 0.8s ease-out 0.2s both;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.1;
        }
        
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 0.75rem 2rem;
            border: 2px solid transparent;
            border-radius: 0.375rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background-color: white;
            color: #F53003;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: white;
            border-color: white;
        }
        
        .btn-secondary:hover {
            background-color: white;
            color: #F53003;
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
        }
        
        /* Cards */
        .card {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
            border: 1px solid #e3e3e0;
        }
        
        body.dark-mode .card {
            background: #161615;
            border-color: #3E3E3A;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }
        
        body.dark-mode .card:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
        }
        
        .card-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1b1b18;
        }
        
        body.dark-mode .card-title {
            color: #EDEDEC;
        }
        
        .card-text {
            color: #706f6c;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        
        body.dark-mode .card-text {
            color: #A1A09A;
        }
        
        .card-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #F53003;
            margin-bottom: 1rem;
        }
        
        /* Grid */
        .grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
        
        @media (min-width: 768px) {
            .grid {
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            }
        }
        
        @media (min-width: 1024px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        /* Section */
        .section {
            padding: 4rem 1.5rem;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            text-align: center;
            color: #1b1b18;
        }
        
        body.dark-mode .section-title {
            color: #EDEDEC;
        }
        
        /* Footer */
        footer {
            background: #1b1b18;
            color: white;
            padding: 2rem 1rem 0.75rem;
            margin-top: 3rem;
        }
        
        body.dark-mode footer {
            background: #0a0a0a;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            max-width: 1400px;
            margin: 0 auto 1.5rem;
            padding: 0 1rem;
        }
        
        .footer-section h4 {
            margin-bottom: 0.75rem;
            color: #F53003;
            font-size: 0.95rem;
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-section ul li {
            margin-bottom: 0.4rem;
        }
        
        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }
        
        .footer-section ul li a:hover {
            color: #F53003;
        }
        
        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 1.5rem;
            padding-bottom: 1rem;
            text-align: center;
            color: #999;
            font-size: 0.85rem;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(20px);
            }
        }
        
        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInFromRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }
        
        .animate-slide-in-left {
            animation: slideInFromLeft 0.6s ease-out;
        }
        
        .animate-slide-in-right {
            animation: slideInFromRight 0.6s ease-out;
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin: 3rem 0;
            flex-wrap: wrap;
        }
        
        .pagination a, .pagination .page-item {
            padding: 0.75rem 1rem;
            border: 1px solid #e3e3e0;
            border-radius: 0.375rem;
            text-decoration: none;
            color: #1b1b18;
            transition: all 0.3s ease;
        }
        
        body.dark-mode .pagination a, body.dark-mode .pagination .page-item {
            border-color: #3E3E3A;
            color: #EDEDEC;
        }
        
        .pagination a:hover, .pagination .page-item:hover {
            background-color: #F53003;
            color: white;
            border-color: #F53003;
        }
        
        .pagination .active {
            background-color: #F53003;
            color: white;
            border-color: #F53003;
        }
        
        /* Loading spinner */
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(245, 48, 3, 0.3);
            border-top-color: #F53003;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            gap: 0.5rem;
            padding: 1rem 0;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .breadcrumb a {
            color: #F53003;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }
        
        .breadcrumb a:hover {
            opacity: 0.8;
        }
        
        .breadcrumb span {
            color: #706f6c;
        }
    </style>
    
    @yield('extra-css')
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="navbar">
            <a href="/" class="logo">
                <i class="fas fa-car"></i> VoiturePro
            </a>
            
            <button class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <div class="nav-links" id="navLinks">
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Accueil</a>
                <a href="/cars" class="nav-link {{ request()->is('cars') ? 'active' : '' }}">Catalogue</a>
                <a href="/sold-cars" class="nav-link {{ request()->is('sold-cars') ? 'active' : '' }}">Voitures Vendues</a>
                <a href="/about" class="nav-link {{ request()->is('about') ? 'active' : '' }}">À Propos</a>
                <a href="/contact" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                <a href="/faq" class="nav-link {{ request()->is('faq') ? 'active' : '' }}">FAQ</a>
               
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>À propos</h4>
                <ul>
                    <li><a href="#about">À propos de VoiturePro</a></li>
                    <li><a href="#team">Notre équipe</a></li>
                    <li><a href="#careers">Carrières</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Services</h4>
                <ul>
                    <li><a href="#catalog">Catalogue</a></li>
                    <li><a href="#financing">Financement</a></li>
                    <li><a href="#maintenance">Maintenance</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="#contact">Nous contacter</a></li>
                    <li><a href="/faq">FAQ</a></li>
                    <li><a href="#privacy">Confidentialité</a></li>
                </ul>
            </div>
            
           <div class="footer-section">
    <h4>Suivez-nous</h4>
    <div style="display: flex; flex-direction: column; gap: 1rem;">
        <div style="display: flex; gap: 1rem; align-items: center;">
            <a href="#" style="color: #F53003; font-size: 1.2rem;"><i class="fab fa-facebook-f"></i></a>
            <a href="#" style="color: #F53003; font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
            <a href="#" style="color: #F53003; font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/221XXXXXXXX" target="_blank" style="color: #25D366; font-size: 1.2rem;"><i class="fab fa-whatsapp"></i></a>
        </div>

        <div style="border-top: 1px solid #333; pt-2; margin-top: 5px; padding-top: 10px;">
            @auth
                <div style="display: flex; gap: 15px; align-items: center;">
                    <a href="/dashboard" style="color: #EDEDEC; text-decoration: none; font-size: 0.85rem; display: flex; align-items: center; gap: 5px;">
                        <i class="fas fa-chart-line" style="color: #F53003;"></i> Administration
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #706f6c; cursor: pointer; font-size: 0.8rem;">
                            <i class="fas fa-power-off"></i> Quitter
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <a href="/login" style="color: #706f6c; text-decoration: none; font-size: 0.8rem; display: flex; align-items: center; gap: 8px; transition: 0.3s;" onmouseover="this.style.color='#F53003'" onmouseout="this.style.color='#706f6c'">
                    <i class="fas fa-lock" style="font-size: 0.7rem;"></i> Accès Collaborateur
                </a>
            @endguest
        </div>
    </div>
</div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 VoiturePro. Tous droits réservés.</p>
        </div>
    </footer>
    
    <script>
        // Mobile menu toggle
        document.getElementById('hamburger').addEventListener('click', function() {
            this.classList.toggle('active');
            document.getElementById('navLinks').classList.toggle('active');
        });
        
        // Close menu when a link is clicked
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('hamburger').classList.remove('active');
                document.getElementById('navLinks').classList.remove('active');
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        
        // Lazy load images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    </script>
    
    @yield('extra-js')
</body>
</html>
