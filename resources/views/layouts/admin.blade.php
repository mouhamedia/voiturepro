<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin - Parking Auto' }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            primary: '#1e40af', 
                            accent: '#f59e0b',  
                            dark: '#0f172a'     
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Styles pour l'état actif des liens */
        .active-link { 
            color: #f59e0b !important; 
            background: rgba(245, 158, 11, 0.1);
            border-left: 4px solid #f59e0b;
        }
        
        /* Transition fluide pour la sidebar */
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Masquer la scrollbar pour une esthétique épurée */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 text-brand-dark antialiased">

    {{-- SIDEBAR NAVIGATION --}}
    <aside id="sidebar" class="sidebar fixed left-0 top-0 h-screen w-72 bg-brand-dark text-white overflow-y-auto no-scrollbar sidebar-transition z-50 transform -translate-x-full md:translate-x-0 shadow-2xl">
        <div class="p-6 border-b border-slate-700/50 sticky top-0 bg-brand-dark z-10">
            <a href="/" class="flex items-center space-x-3 group">
                <div class="bg-brand-accent p-2 rounded-xl group-hover:rotate-12 transition-transform shadow-lg shadow-brand-accent/20">
                    <i class="fas fa-car-side text-brand-dark text-lg"></i>
                </div>
                <span class="font-black text-xl uppercase tracking-tighter">
                    PARKING<span class="text-brand-accent italic font-extrabold">AUTO</span>
                </span>
            </a>
        </div>

        <nav class="p-4 space-y-1.5">
            <div class="pt-4 pb-2 px-4">
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">Menu Principal</h3>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-all duration-200 group {{ Request::is('admin') || Request::is('dashboard') ? 'active-link' : '' }}">
                <i class="fas fa-chart-line w-5 text-center group-hover:scale-110"></i>
                <span class="text-sm font-bold">Tableau de Bord</span>
            </a>

            <a href="{{ route('admin.cars.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-all duration-200 group {{ Request::is('admin/cars*') ? 'active-link' : '' }}">
                <i class="fas fa-car w-5 text-center group-hover:scale-110"></i>
                <span class="text-sm font-bold">Gestion Stock</span>
            </a>

            <a href="{{ route('admin.cars.create') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-all duration-200 group">
                <i class="fas fa-plus-circle w-5 text-center group-hover:scale-110"></i>
                <span class="text-sm font-bold">Nouvelle Voiture</span>
            </a>

            <a href="{{ route('admin.sales.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-all duration-200 group {{ Request::is('admin/sales*') ? 'active-link' : '' }}">
                <i class="fas fa-receipt w-5 text-center group-hover:scale-110"></i>
                <span class="text-sm font-bold">Historique Ventes</span>
            </a>

            <div class="pt-6 pb-2 px-4">
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">Vue Client</h3>
            </div>

            <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-all duration-200 group">
                <i class="fas fa-external-link-alt w-5 text-center group-hover:scale-110 text-slate-400"></i>
                <span class="text-sm font-bold">Voir le Site</span>
            </a>

            <div class="pt-10">
                <form method="POST" action="{{ route('logout') }}" class="px-2">
                    @csrf
                    <button class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl bg-red-500/10 hover:bg-red-600 transition-all duration-300 text-red-400 hover:text-white group">
                        <i class="fas fa-power-off w-5 text-center group-hover:rotate-90 transition-transform"></i>
                        <span class="text-sm font-bold">Déconnexion</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- OVERLAY FOR MOBILE --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-brand-dark/50 z-40 hidden backdrop-blur-sm transition-opacity"></div>

    {{-- TOP NAVIGATION BAR --}}
    <header class="fixed top-0 right-0 left-0 md:left-72 bg-white/80 backdrop-blur-md border-b border-slate-200 z-30 sidebar-transition">
        <div class="flex justify-between items-center h-16 px-4 md:px-8">
            <button class="md:hidden p-2 text-brand-dark hover:bg-slate-100 rounded-lg transition" id="sidebar-toggle">
                <i class="fas fa-bars-staggered text-xl"></i>
            </button>

            <div class="hidden md:block">
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Espace Administration</h2>
            </div>

            <div class="flex items-center space-x-3 md:space-x-6">
                <div class="flex items-center space-x-3 pl-4 border-l border-slate-200">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-black text-brand-dark leading-none">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-brand-accent font-bold uppercase tracking-tighter">Super Admin</p>
                    </div>
                    <div class="relative group">
                        <div class="w-10 h-10 rounded-xl bg-brand-primary flex items-center justify-center text-white font-black shadow-lg shadow-brand-primary/20 cursor-pointer group-hover:scale-105 transition-transform">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="md:ml-72 pt-16 sidebar-transition min-h-screen relative">
        <div class="p-4 md:p-8">
            {{-- ALERTS --}}
            @if(session('success'))
                <div class="fixed top-20 right-4 z-[60] bg-white border-l-4 border-green-500 p-4 rounded-xl shadow-2xl flex items-center space-x-4 animate-[slideIn_0.3s_ease-out]">
                    <div class="bg-green-100 p-2 rounded-full text-green-600">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle = document.getElementById('sidebar-toggle');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        if (toggle) {
            toggle.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
        }

        // Auto-hide alerts avec effet de fondu
        setTimeout(() => {
            const alerts = document.querySelectorAll('.animate-\\[slideIn_0\\.3s_ease-out\\]');
            alerts.forEach(alert => {
                alert.classList.add('opacity-0', 'translate-x-10', 'transition-all', 'duration-500');
                setTimeout(() => alert.remove(), 500);
            });
        }, 4000);
    </script>

    <style>
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</body>
</html>