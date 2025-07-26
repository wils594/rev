<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier {{ $femme->prenom }} {{ $femme->nom }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f1f3f5;
        }
        .edit-form {
            max-width: 500px;
            margin: auto;
            margin-top: 5%;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .current-photo {
            max-width: 150px;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="edit-form">
        <h3 class="text-center mb-4">Modifier les informations</h3>

        <form method="POST" action="{{ route('femmes.update', $femme->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $femme->nom) }}" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $femme->prenom) }}" required>
            </div>

            <div class="mb-3">
                <label for="activite" class="form-label">Activité</label>
                <input type="text" name="activite" id="activite" class="form-control" value="{{ old('activite', $femme->activite) }}" required>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $femme->telephone) }}" required>
            </div>

            <input type="hidden" name="sexe" value="femme">

            {{-- Affichage photo actuelle si elle existe --}}
            @if($femme->photo)
                <div class="mb-3 text-center">
                    <label class="form-label d-block">Photo actuelle :</label>
                    <img src="{{ asset('storage/photos/' . $femme->photo) }}" alt="Photo de {{ $femme->nom }}" class="current-photo">
                </div>
            @endif

            <div class="mb-4">
                <label for="photo" class="form-label">Changer la photo (optionnel)</label>
                <input type="file" name="photo" id="photo" class="form-control" accept="image/*" />
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('femmes.show', $femme->id) }}" class="btn btn-link">Retour à la fiche</a>
        </div>
    </div>

</body>
</html>
