<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des femmes enregistrées</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-container {
            margin-top: 3rem;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <div class="container main-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>👩 Liste des femmes</h2>
            <a href="{{ route('femmes.create') }}" class="btn btn-success">➕ Ajouter une femme</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-3">
            @if($femmes->isEmpty())
                <p class="text-muted text-center">Aucune femme enregistrée.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Activité</th>
                                <th>Sexe</th>
                                <th>Téléphone</th>
                                <th>Paiement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($femmes as $femme)
                                <tr>
                                    <td>{{ $femme->id }}</td>
                                    <td>{{ $femme->nom }}</td>
                                    <td>{{ $femme->prenom }}</td>
                                    <td>{{ $femme->activite }}</td>
                                    <td>{{ $femme->sexe }}</td>
                                    <td>{{ $femme->telephone }}</td>
                                    <td>
                                        @if($femme->statut_paiement === 'à jour')
                                            <span class="badge bg-success">À jour</span>
                                        @else
                                            <span class="badge bg-danger">Non payé</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ route('femmes.show', $femme->id) }}" class="btn btn-sm btn-primary">Voir</a>

                                            <a href="{{ route('femmes.edit', $femme->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                                            @if($femme->statut_paiement !== 'à jour')
                                                <form method="POST" action="{{ route('femmes.paiement', $femme->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success"> Paiement</button>
                                                </form>
                                            @endif

                                            <form action="{{ route('femmes.destroy', $femme->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"> Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</body>
</html>
