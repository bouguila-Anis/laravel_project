<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — Espace Étudiant CSFT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a3c6e; /* Bleu Marine officiel CSFT */
            --secondary-color: #f4f6f9;
        }
        body {
            background-color: var(--secondary-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-card {
            border: none;
            border-top: 5px solid var(--primary-color);
            border-radius: 8px;
        }
        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #112749;
            color: white;
        }
        .text-primary-custom {
            color: var(--primary-color);
        }
    </style>
</head>
<body class="d-flex align-items-center py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary-custom">CSFT Cité El Khadra</h2>
                <p class="text-muted">Création de votre compte Espace Numérique</p>
            </div>

            <div class="card register-card shadow-sm p-4">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nom et Prénom</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Vous êtes :</label>
                        <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required onchange="toggleGroupSelection()">
                            <option value="" disabled selected>Choisir votre profil...</option>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Étudiant (Stagiaire)</option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Formateur</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="group-field" style="display: none;">
                        <label for="group_id" class="form-label">Votre Groupe</label>
                        <select name="group_id" id="group_id" class="form-select @error('group_id') is-invalid @enderror">
                            <option value="" disabled selected>Sélectionnez votre groupe (ex: BTS TSMM 125)...</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('group_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-custom py-2">S'inscrire et se connecter</button>
                    </div>

                    <div class="text-center mt-3">
                        <span class="text-muted">Déjà un compte ?</span>
                        <a href="{{ route('login') }}" class="text-primary-custom fw-bold text-decoration-none">Se connecter</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleGroupSelection() {
        const roleSelect = document.getElementById('role');
        const groupField = document.getElementById('group-field');
        const groupSelect = document.getElementById('group_id');

        if (roleSelect.value === 'student') {
            groupField.style.display = 'block';
            groupSelect.setAttribute('required', 'required');
        } else {
            groupField.style.display = 'none';
            groupSelect.removeAttribute('required');
            groupSelect.value = '';
        }
    }

    // Exécuter au chargement pour gérer le retour d'erreur (old value)
    window.onload = toggleGroupSelection;
</script>
</body>
</html>
