<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — CSFT Cité El Khadra</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:       #1a3c6e;
            --primary-light: #2a5298;
            --primary-dark:  #0f2444;
            --accent:        #e8a020;
            --accent-light:  #f5c050;
            --bg:            #f0f4f8;
            --white:         #ffffff;
            --text-dark:     #1a2535;
            --text-muted:    #6b7a8d;
            --border:        #d1dce8;
            --error:         #dc3545;
            --success:       #28a745;
            --shadow-card:   0 20px 60px rgba(26, 60, 110, 0.15);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
        }

        /* ── Panneau gauche décoratif ── */
        .panel-left {
            flex: 1;
            background: linear-gradient(145deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-light) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 320px; height: 320px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 250px; height: 250px;
            background: rgba(232,160,32,0.08);
            border-radius: 50%;
        }

        .panel-logo {
            width: 90px; height: 90px;
            background: rgba(255,255,255,0.12);
            border: 2px solid rgba(255,255,255,0.25);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif;
            font-size: 26px; font-weight: 700;
            color: var(--white);
            letter-spacing: 1px;
            margin-bottom: 32px;
            backdrop-filter: blur(8px);
        }

        .panel-title {
            font-family: 'Sora', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--white);
            text-align: center;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .panel-subtitle {
            font-size: 14px;
            color: rgba(255,255,255,0.65);
            text-align: center;
            line-height: 1.6;
            max-width: 280px;
        }

        .panel-badge {
            margin-top: 40px;
            background: rgba(232,160,32,0.2);
            border: 1px solid rgba(232,160,32,0.4);
            color: var(--accent-light);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 6px 16px;
            border-radius: 20px;
        }

        /* ── Panneau droit — formulaire ── */
        .panel-right {
            width: 480px;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 50px;
        }

        .login-box { width: 100%; }

        .login-header { margin-bottom: 36px; }

        .login-header h2 {
            font-family: 'Sora', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* ── Messages flash ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert-error   { background: #fdf0f0; border: 1px solid #f5c6cb; color: #7d1a1a; }
        .alert-success { background: #f0fdf4; border: 1px solid #a8d5b5; color: #1a4d2a; }

        /* ── Champs ── */
        .form-group { margin-bottom: 22px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        .input-wrapper { position: relative; }

        .input-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            width: 16px; height: 16px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: var(--text-dark);
            background: #fafbfc;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
        }
        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(42,82,152,0.1);
            background: var(--white);
        }
        .form-control.is-invalid { border-color: var(--error); }

        .invalid-feedback {
            font-size: 12px;
            color: var(--error);
            margin-top: 5px;
            display: block;
        }

        /* ── Remember + Forgot ── */
        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .remember-label {
            display: flex; align-items: center; gap: 8px;
            color: var(--text-muted);
            cursor: pointer;
        }
        .remember-label input[type="checkbox"] { accent-color: var(--primary); }

        .forgot-link {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* ── Bouton ── */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 4px 15px rgba(26,60,110,0.3);
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26,60,110,0.4);
        }
        .btn-login:active { transform: translateY(0); }

        /* ── Footer ── */
        .login-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ── Responsive ── */
        @media (max-width: 860px) {
            .panel-left { display: none; }
            .panel-right { width: 100%; padding: 40px 30px; }
        }
    </style>
</head>
<body>

    {{-- Panneau gauche --}}
    <div class="panel-left">
        <div class="panel-logo">CSFT</div>
        <h1 class="panel-title">Centre Sectoriel de Formation en Télécom</h1>
        <p class="panel-subtitle">Cité El Khadra — Tunis<br>Ministère de l'Emploi et de la Formation Professionnelle</p>
        <span class="panel-badge">Espace Numérique Étudiant</span>
    </div>

    {{-- Panneau droit — formulaire --}}
    <div class="panel-right">
        <div class="login-box">
            <div class="login-header">
                <h2>Connexion</h2>
                <p>Accédez à votre espace personnalisé</p>
            </div>

            {{-- Message de succès (ex: après déconnexion) --}}
            @if (session('success'))
                <div class="alert alert-success">
                    <span>✓</span> {{ session('success') }}
                </div>
            @endif

            {{-- Erreurs générales --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    <span>⚠</span>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="votre.nom@csft.tn"
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Mot de passe --}}
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            autocomplete="current-password"
                        >
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Se souvenir + mot de passe oublié --}}
                <div class="form-footer">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Se souvenir de moi
                    </label>
                    {{-- <a href="{{ route('password.request') }}" class="forgot-link">Mot de passe oublié ?</a> --}}
                </div>

                <button type="submit" class="btn-login">
                    Se connecter →
                </button>
                <a href="{{ route('register') }}" class="btn w-50 py-2 border-secondary-custom" style="border: 1px solid var(--primary-color); color: var(--primary-color); background: transparent; transition: all 0.3s ease;">
                    S'inscrire
                </a>
            </form>

            <div class="login-footer">
                © {{ date('Y') }} CSFT Cité El Khadra — Tous droits réservés
            </div>
        </div>
    </div>

</body>
</html>
