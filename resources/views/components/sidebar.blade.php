{{--
    Composant : <x-sidebar :active="'dashboard'" />
    Fichier   : resources/views/components/sidebar.blade.php

    Props :
      - $active (string) : slug du lien actif, ex. 'dashboard', 'courses', etc.
        Valeur par défaut : 'dashboard'
--}}

@props(['active' => 'dashboard'])

{{--
    Données du menu : chaque entrée expose
      - key     : identifiant unique (comparé à $active)
      - icon    : emoji / unicode
      - label   : texte affiché
      - route   : route nommée Laravel (ou '#' si non encore définie)
      - badge   : (optionnel) chiffre affiché dans un badge
--}}
@php
$menuItems = [
    [
        'key'   => 'dashboard',
        'icon'  => '🏠',
        'label' => 'Tableau de bord',
        'route' => 'dashboard',
    ],
    [
        'key'   => 'courses',
        'icon'  => '📚',
        'label' => 'Mes Cours',
        'route' => '#',
        'badge' => '6',
    ],
    [
        'key'   => 'schedule',
        'icon'  => '📅',
        'label' => 'Emploi du temps',
        'route' => '#',
    ],
    [
        'key'   => 'grades',
        'icon'  => '📝',
        'label' => 'Mes Notes',
        'route' => '#',
    ],
    [
        'key'   => 'messages',
        'icon'  => '💬',
        'label' => 'Messages',
        'route' => '#',
        'badge' => '3',
    ],
];

$settingsItems = [
    [
        'key'   => 'settings',
        'icon'  => '⚙️',
        'label' => 'Paramètres',
        'route' => '#',
    ],
];
@endphp

<aside class="sidebar" role="navigation" aria-label="Menu principal">

    {{-- ── Section principale ───────────────────────────────── --}}
    <p class="sidebar-section-label">Navigation</p>

    <nav>
        <ul class="sidebar-nav" role="list">
            @foreach ($menuItems as $item)
                <li>
                    {{--
                        display: flex + gap : icône et libellé alignés
                        horizontalement (cf. style.css .sidebar-nav a)

                        La classe .active est ajoutée dynamiquement :
                        si $active correspond à la clé de l'item,
                        le lien reçoit la classe + le ::before CSS s'affiche.
                    --}}
                    <a
                        href="{{ $item['route'] === '#' ? '#' : route($item['route']) }}"
                        class="{{ $active === $item['key'] ? 'active' : '' }}"
                        aria-current="{{ $active === $item['key'] ? 'page' : 'false' }}"
                    >
                        <span class="nav-icon" aria-hidden="true">{{ $item['icon'] }}</span>
                        <span class="nav-label">{{ $item['label'] }}</span>

                        @if (!empty($item['badge']))
                            <span class="nav-badge" aria-label="{{ $item['badge'] }} éléments">
                                {{ $item['badge'] }}
                            </span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <div class="sidebar-divider" role="separator"></div>

    {{-- ── Section paramètres ───────────────────────────────── --}}
    <p class="sidebar-section-label">Compte</p>

    <nav aria-label="Paramètres du compte">
        <ul class="sidebar-nav" role="list">
            @foreach ($settingsItems as $item)
                <li>
                    <a
                        href="#"
                        class="{{ $active === $item['key'] ? 'active' : '' }}"
                        aria-current="{{ $active === $item['key'] ? 'page' : 'false' }}"
                    >
                        <span class="nav-icon" aria-hidden="true">{{ $item['icon'] }}</span>
                        <span class="nav-label">{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    {{-- ── Carte utilisateur (bas de sidebar) ─────────────── --}}
    <div class="sidebar-user">
        <div class="sidebar-user-card" role="button" tabindex="0" aria-label="Profil de El Amri Ahmed">
            <div class="sidebar-user-avatar" aria-hidden="true">SA</div>
            <div class="sidebar-user-info">
                <p class="sidebar-user-name">Stagiaire Anonyme</p>
                <p class="sidebar-user-role">Departement - Multimédia</p>
            </div>
        </div>
    </div>

</aside>
