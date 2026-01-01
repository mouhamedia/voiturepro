<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'VoiturePro - Plateforme de Vente de Voitures')</title>
    <meta name="description" content="@yield('description', 'Découvrez notre collection de voitures neuves et d\'occasion de qualité')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* --- Tes styles existants ici --- */
        
        /* Ajout d'une transition douce pour le changement de thème */
        body { transition: background-color 0.3s, color 0.3s; }

        /* Style pour le bouton de bascule de thème (Optionnel) */
        .theme-toggle {
            background: none;
            border: none;
            cursor: pointer;
            color: inherit;
            font-size: 1.2rem;
            padding: 0.5rem;
        }
    </style>
    
    @yield('extra-css')
</head>
<body class="{{ (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') ? 'dark-mode' : '' }}">

    <nav>
        <div class="navbar">
            <a href="{{ url('/') }}" class="logo">
                <i class="fas fa-car-side"></i> VoiturePro
            </a>
            
            <div class="nav-actions" style="display: flex; align-items: center; gap: 1rem;">
                <button id="themeToggle" class="theme-toggle">
                    <i class="fas fa-moon"></i>
                </button>

                <button class="hamburger" id="hamburger">
                    <span></span><span></span><span></span>
                </button>
            </div>
            
            <div class="nav-links" id="navLinks">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Accueil</a>
                <a href="{{ url('/cars') }}" class="nav-link {{ request()->is('cars*') ? 'active' : '' }}">Catalogue</a>
                <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">À Propos</a>
                <a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Admin</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link" style="background:none; border:none; cursor:pointer;">Déconnexion</button>
                    </form>
                @endauth
                
                @guest
                    <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                @endguest
            </div>
        </div>
    </nav>
    
    <main id="app">
        @yield('content')
    </main>

    <footer>
        </footer>

    <script>
        // Menu Mobile
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('navLinks');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        // Gestion du Dark Mode (Persistant)
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            const isDark = body.classList.contains('dark-mode');
            themeToggle.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            document.cookie = "theme=" + (isDark ? "dark" : "light") + ";path=/;max-age=31536000";
        });
    </script>
    
    @yield('extra-js')
</body>
</html>