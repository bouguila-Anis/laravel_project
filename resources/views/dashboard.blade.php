{{--
    Vue      : resources/views/dashboard.blade.php
    Route    : GET /dashboard  → name('dashboard')
    Layout   : <x-layouts.app> (Anonymous Component)

    Passage de props au layout :
      - title  : onglet du navigateur
      - active : lien actif dans la sidebar
--}}

<x-layouts.app title="Tableau de bord" :active="'dashboard'">

    {{-- ══════════════════════════════════════════════════════
         EN-TÊTE DE PAGE
         ═════════════════════════════════════════════════════ --}}
    <section class="page-header" aria-labelledby="page-title">
        <div class="page-header-text">
            <h2 id="page-title">Bonjour, Ahmed 👋</h2>
            <p>Voici un résumé de votre activité académique.</p>
        </div>
        <div class="page-header-actions">
            <button class="btn-primary" type="button">
                📄 Télécharger mon relevé
            </button>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════
         STATISTIQUES RAPIDES
         ═════════════════════════════════════════════════════ --}}
    <section aria-label="Statistiques">
        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon blue" aria-hidden="true">📚</div>
                <div class="stat-info">
                    <p class="stat-value">6</p>
                    <p class="stat-label">Cours inscrits</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon gold" aria-hidden="true">⭐</div>
                <div class="stat-info">
                    <p class="stat-value">14,8</p>
                    <p class="stat-label">Moyenne générale</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green" aria-hidden="true">✅</div>
                <div class="stat-info">
                    <p class="stat-value">92%</p>
                    <p class="stat-label">Assiduité</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon purple" aria-hidden="true">📝</div>
                <div class="stat-info">
                    <p class="stat-value">3</p>
                    <p class="stat-label">Devoirs à rendre</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════
         GRILLE PRINCIPALE : Cours + Agenda
         ═════════════════════════════════════════════════════ --}}
    <div class="content-grid">

        {{-- ── Mes cours en cours ──────────────────────────── --}}
        <article class="card" aria-label="Progression des cours">
            <div class="card-header">
                <h3 class="card-title">Mes cours en cours</h3>
                <a href="#" class="card-link">Voir tout →</a>
            </div>
            <div class="card-body">
                <ul class="course-list" role="list">

                    <li class="course-item">
                        <div class="course-color-bar" style="background:#1b3a6b;"></div>
                        <div class="course-info">
                            <p class="course-name">Algorithmique avancée</p>
                            <p class="course-meta">Pr. Benali • Semestre 5</p>
                        </div>
                        <div class="course-progress-wrap">
                            <p class="course-pct">78%</p>
                            <div class="progress-bar"><div class="progress-fill" style="width:78%"></div></div>
                        </div>
                    </li>

                    <li class="course-item">
                        <div class="course-color-bar" style="background:#e8b84b;"></div>
                        <div class="course-info">
                            <p class="course-name">Bases de données</p>
                            <p class="course-meta">Pr. Mansouri • Semestre 5</p>
                        </div>
                        <div class="course-progress-wrap">
                            <p class="course-pct">55%</p>
                            <div class="progress-bar"><div class="progress-fill" style="width:55%"></div></div>
                        </div>
                    </li>

                    <li class="course-item">
                        <div class="course-color-bar" style="background:#22c55e;"></div>
                        <div class="course-info">
                            <p class="course-name">Réseaux informatiques</p>
                            <p class="course-meta">Pr. Charef • Semestre 5</p>
                        </div>
                        <div class="course-progress-wrap">
                            <p class="course-pct">90%</p>
                            <div class="progress-bar"><div class="progress-fill" style="width:90%"></div></div>
                        </div>
                    </li>

                    <li class="course-item">
                        <div class="course-color-bar" style="background:#8b5cf6;"></div>
                        <div class="course-info">
                            <p class="course-name">Développement Web</p>
                            <p class="course-meta">Pr. Khaldi • Semestre 5</p>
                        </div>
                        <div class="course-progress-wrap">
                            <p class="course-pct">40%</p>
                            <div class="progress-bar"><div class="progress-fill" style="width:40%"></div></div>
                        </div>
                    </li>

                </ul>
            </div>
        </article>

        {{-- ── Agenda du jour ──────────────────────────────── --}}
        <article class="card" aria-label="Agenda du jour">
            <div class="card-header">
                <h3 class="card-title">Agenda du jour</h3>
                <a href="#" class="card-link">Planning →</a>
            </div>
            <div class="card-body">
                <ul class="agenda-list" role="list">

                    <li class="agenda-item">
                        <div class="agenda-time">
                            <p class="agenda-hour">08h00</p>
                            <p class="agenda-period">AM</p>
                        </div>
                        <div class="agenda-dot" style="background:#1b3a6b;"></div>
                        <div class="agenda-detail">
                            <p class="agenda-subject">Algorithmique avancée</p>
                            <p class="agenda-room">Salle B-204</p>
                        </div>
                    </li>

                    <li class="agenda-item">
                        <div class="agenda-time">
                            <p class="agenda-hour">10h30</p>
                            <p class="agenda-period">AM</p>
                        </div>
                        <div class="agenda-dot" style="background:#e8b84b;"></div>
                        <div class="agenda-detail">
                            <p class="agenda-subject">TD Bases de données</p>
                            <p class="agenda-room">Labo Informatique 3</p>
                        </div>
                    </li>

                    <li class="agenda-item">
                        <div class="agenda-time">
                            <p class="agenda-hour">14h00</p>
                            <p class="agenda-period">PM</p>
                        </div>
                        <div class="agenda-dot" style="background:#22c55e;"></div>
                        <div class="agenda-detail">
                            <p class="agenda-subject">Réseaux – TP Cisco</p>
                            <p class="agenda-room">Salle Réseau</p>
                        </div>
                    </li>

                    <li class="agenda-item">
                        <div class="agenda-time">
                            <p class="agenda-hour">16h30</p>
                            <p class="agenda-period">PM</p>
                        </div>
                        <div class="agenda-dot" style="background:#8b5cf6;"></div>
                        <div class="agenda-detail">
                            <p class="agenda-subject">Rendu Projet Laravel</p>
                            <p class="agenda-room">En ligne – Moodle</p>
                        </div>
                    </li>

                </ul>
            </div>
        </article>

    </div>

</x-layouts.app>
