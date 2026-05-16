<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Titre dynamique (chaque page peut surcharger $title) --}}
    <title>{{ $title ?? 'Tableau de bord' }} – CSFT Espace Étudiant</title>

    {{-- Google Fonts : DM Sans + Source Serif 4 --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Source+Serif+4:wght@300;400;600&display=swap" rel="stylesheet">

    {{-- Feuille de style externe --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Styles supplémentaires par page (stack optionnel) --}}
    @stack('styles')
</head>
<body>

    {{--
          HEADER – composant réutilisable
    }}
    <x-header />

    {{-- Wrapper principal : sidebar + contenu --}}
    <div class="app-layout">

        {{-- ╔══════════════════════════════════════════╗
             ║  SIDEBAR – composant réutilisable       ║
             ╚══════════════════════════════════════════╝ --}}
        <x-sidebar :active="$active ?? 'dashboard'" />

        {{-- ╔══════════════════════════════════════════╗
             ║  CONTENU PRINCIPAL                      ║
             ╚══════════════════════════════════════════╝ --}}
        <main class="main-content" role="main">

            {{-- Slot : chaque vue enfant injecte son contenu ici --}}
            {{ $slot }}

            {{-- Pied de page interne --}}
            <footer class="site-footer">
                © {{ date('Y') }} CSFT – Centre Supérieur de Formation Technologique &mdash; Tous droits réservés
            </footer>

        </main>

    </div>

    @stack('scripts')
</body>
</html>
