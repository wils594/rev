<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de {{ $femme->prenom }} {{ $femme->nom }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2f4f8;
            padding: 2rem;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .qr-img {
            max-width: 200px;
        }
        .photo-img {
            max-width: 200px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            margin-bottom: 1.5rem;
        }
        .status {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="card p-4 mt-5 w-100" style="max-width: 600px;">
            <h3 class="text-center mb-4">Fiche d'identité</h3>

            <!-- Message de succès -->
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- QR Code -->
            <div class="text-center mb-4">
                @if($femme->qr_code_path)
                    <img src="{{ asset('storage/' . $femme->qr_code_path) }}" class="qr-img" alt="QR Code">
                @endif
            </div>

            <!-- Photo de la femme -->
            <div class="text-center mb-4">
                @if($femme->photo)
                    <img src="{{ asset('storage/photos/' . $femme->photo) }}" alt="Photo de {{ $femme->prenom }}" class="photo-img">
                @else
                    <p class="text-muted">Bienvenue sur la fiche du commercante</p>
                @endif
            </div>

            <!-- Infos -->
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nom :</strong> {{ $femme->nom }}</li>
                <li class="list-group-item"><strong>Prénom :</strong> {{ $femme->prenom }}</li>
                <li class="list-group-item"><strong>Activité :</strong> {{ $femme->activite }}</li>
                <li class="list-group-item"><strong>Téléphone :</strong> {{ $femme->telephone }}</li>
                <li class="list-group-item">
                    <strong>Statut de paiement :</strong>
                    @if($femme->statut_paiement === 'à jour')
                        <span class="badge bg-success">À jour</span>
                    @else
                        <span class="badge bg-danger">Non payé</span>
                    @endif
                </li>
            </ul>

            <!-- Actions -->
            <div class="mt-4 text-center">
                <a href="{{ route('femmes.edit', $femme->id) }}" class="btn btn-outline-primary me-2">Modifier</a>

                @if($femme->statut_paiement !== 'à jour')
                    <form action="{{ route('femmes.paiement', $femme->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Marquer comme payé</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
