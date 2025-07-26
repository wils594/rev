<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement - {{ $femme->nom }} {{ $femme->prenom }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Mettre à jour le paiement</h4>
        </div>
        <div class="card-body">
            <h5>{{ $femme->nom }} {{ $femme->prenom }}</h5>
            <p><strong>Activité :</strong> {{ $femme->activite }}</p>
            <p><strong>Téléphone :</strong> {{ $femme->telephone }}</p>

            <form method="POST" action="{{ route('femmes.paiement', ['id' => $femme->id]) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Statut actuel :</label>
                    <div class="alert {{ $femme->paiement_status ? 'alert-success' : 'alert-warning' }}">
                        {{ $femme->paiement_status ? '✅ Paiement effectué' : '❌ Paiement en attente' }}
                    </div>
                </div>

                @if (!$femme->paiement_status)
                    <button type="submit" class="btn btn-success">Confirmer le Paiement</button>
                @else
                    <button type="button" class="btn btn-secondary" disabled>Déjà payé</button>
                @endif

                <a href="{{ route('femmes.index') }}" class="btn btn-outline-secondary ms-2">Retour à la liste</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
