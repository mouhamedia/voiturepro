@extends('layouts.main')

@section('content')

<div style="display: flex; align-items: center; justify-content: center; min-height: calc(100vh - 80px); padding: 2rem 1rem; background: #FDFDFC;">
    <div style="width: 100%; max-width: 450px; animation: slideUp 0.6s ease-out;">
        
        <div style="background: white; border-radius: 1.5rem; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); overflow: hidden; border: 1px solid #e3e3e0;">
            
            <div style="background: #1b1b18; padding: 3rem 2rem; text-align: center; color: white; position: relative;">
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 4px; background: #F53003;"></div>
                
                <div style="width: 70px; height: 70px; background: rgba(245, 48, 3, 0.1); border: 2px solid #F53003; border-radius: 1rem; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user-shield" style="font-size: 2rem; color: #F53003;"></i>
                </div>
                <h1 style="font-size: 1.75rem; font-weight: 700; margin: 0 0 0.5rem 0; letter-spacing: -0.5px;">Accès Privé</h1>
                <p style="margin: 0; color: #A1A09A; font-size: 0.95rem;">Gestion de la plateforme VoiturePro</p>
            </div>

            <div style="padding: 3rem 2.5rem;">
                
                @if($errors->any())
                    <div style="background: #FFF2F2; border-left: 4px solid #F53003; border-radius: 0.5rem; padding: 1rem; margin-bottom: 2rem;">
                        <ul style="color: #F53003; margin: 0; padding: 0; list-style: none; font-size: 0.9rem; font-weight: 600;">
                            @foreach($errors->all() as $error)
                                <li><i class="fas fa-times-circle mr-2"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @csrf

                    <div>
                        <label style="display: block; color: #1b1b18; font-weight: 600; margin-bottom: 0.6rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            Email Professionnel
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            style="width: 100%; padding: 1rem; border: 1.5px solid #e3e3e0; border-radius: 0.75rem; font-size: 1rem; transition: all 0.3s ease; background: #F9F9F8;"
                            onfocus="this.style.borderColor='#F53003'; this.style.backgroundColor='#fff'; this.style.outline='none';"
                            onblur="this.style.borderColor='#e3e3e0'; this.style.backgroundColor='#F9F9F8';">
                    </div>

                    <div>
                        <label style="display: block; color: #1b1b18; font-weight: 600; margin-bottom: 0.6rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            Mot de passe
                        </label>
                        <input type="password" name="password" required
                            style="width: 100%; padding: 1rem; border: 1.5px solid #e3e3e0; border-radius: 0.75rem; font-size: 1rem; transition: all 0.3s ease; background: #F9F9F8;"
                            onfocus="this.style.borderColor='#F53003'; this.style.backgroundColor='#fff'; this.style.outline='none';"
                            onblur="this.style.borderColor='#e3e3e0'; this.style.backgroundColor='#F9F9F8';">
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-top: -0.5rem;">
                        <input type="checkbox" name="remember" id="remember" style="accent-color: #F53003; width: 1.2rem; height: 1.2rem; cursor: pointer;">
                        <label for="remember" style="color: #706f6c; font-size: 0.9rem; cursor: pointer; user-select: none;">Rester connecté</label>
                    </div>

                    <button type="submit" style="background: #F53003; color: white; padding: 1.1rem; border-radius: 0.75rem; font-weight: 700; font-size: 1rem; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(245, 48, 3, 0.2);"
                        onmouseover="this.style.transform='translateY(-3px)'; this.style.backgroundColor='#d42102'; this.style.boxShadow='0 15px 25px rgba(245, 48, 3, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.backgroundColor='#F53003';">
                        Accéder au Dashboard <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                    </button>
                </form>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="/" style="color: #706f6c; text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: color 0.3s ease;"
                       onmouseover="this.style.color='#F53003'" onmouseout="this.style.color='#706f6c'">
                        <i class="fas fa-chevron-left" style="font-size: 0.8rem; margin-right: 5px;"></i> Retour au site public
                    </a>
                </div>
            </div>
        </div>

        <p style="text-align: center; color: #A1A09A; font-size: 0.85rem; margin-top: 2rem;">
            Système de Gestion VoiturePro v2.0 — Sécurisé par SSL
        </p>
    </div>
</div>

@endsection