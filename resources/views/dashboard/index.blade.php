@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="page-header">
    <h1>Bonjour, {{ auth()->user()->name }} 👋</h1>
    <p>Bienvenue dans votre espace {{ auth()->user()->role_label }}.</p>
</div>

<p style="color: var(--text-muted); font-size: 14px;">
    Le contenu de ce tableau de bord sera généré en <strong>Phase 2</strong>.<br>
    Rôle détecté : <code>{{ auth()->user()->role }}</code> —
    Matricule : <code>{{ auth()->user()->matricule ?? 'N/A' }}</code>
</p>
@endsection
