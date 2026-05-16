{{--
    Composant : <x-header />
    Fichier   : resources/views/components/header.blade.php

    Ce composant est autonome : il n'a besoin d'aucune prop obligatoire.
    Il peut accepter des props optionnelles via @props() si nécessaire.
--}}

<header class="site-header" role="banner">

    {{-- ── Marque / Logo ──────────────────────────────────────── --}}
    <div class="header-brand">
        <div class="logo-mark" aria-hidden="true">CS</div>

        {{-- H1 unique dans la page – titre principal de l'application --}}
        <h1>
            CSFT
            <span>Espace Stagiaire</span>
        </h1>
    </div>

    {{-- ── Barre de recherche ──────────────────────────────────── --}}
    <div class="header-search" role="search">
        <span class="search-icon" aria-hidden="true">🔍</span>
        <input
            type="search"
            placeholder="Rechercher un cours, un document…"
            aria-label="Recherche"
        >
    </div>

    {{-- ── Actions (notifications, messages, avatar) ──────────── --}}
    <div class="header-actions">

        {{-- Notifications --}}
        <button class="header-btn" aria-label="Notifications" title="Notifications">
            🔔
            <span class="badge" aria-label="3 nouvelles notifications"></span>
        </button>

        {{-- Messages --}}
        <button class="header-btn" aria-label="Messages" title="Messages">
            ✉️
        </button>

        {{-- Avatar utilisateur --}}
        <div class="header-avatar" role="button" tabindex="0" aria-label="Mon profil" title="Mon profil">
            SA
        </div>

    </div>

</header>
