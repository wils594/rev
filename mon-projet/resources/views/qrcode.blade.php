<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accueil - Générateur de QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1.25rem;
            padding: 3rem 2rem;
            max-width: 480px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
        }
        h1 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
        }
        p.lead {
            font-size: 1.15rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.2);
        }
        .btn-primary, .btn-success, .btn-warning, .btn-info {
            border: none;
            padding: 1rem 2.5rem;
            font-size: 1.25rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            width: 100%;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 15px hsla(256, 41%, 95%, 0.50);
        }
        .btn-primary {
            background-color: #b89494ff;
        }
        .btn-primary:hover {
            background-color: #efeef2ff;
            box-shadow: 0 6px 20px rgba(237, 235, 244, 0.7);
        }
        .btn-success {
            background-color: #22c55e;
        }
        .btn-success:hover {
            background-color: #4ade80;
            box-shadow: 0 6px 20px rgba(74, 222, 128, 0.7);
        }
        .btn-warning {
            background-color: #f59e0b;
        }
        .btn-warning:hover {
            background-color: #fbbf24;
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.7);
        }
        .btn-info {
            background-color: #3b82f6;
        }
        .btn-info:hover {
            background-color: #60a5fa;
            box-shadow: 0 6px 20px rgba(96, 165, 250, 0.7);
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Bienvenue sur le Générateur de QR Code</h1>
        <p class="lead">Enregistrez facilement une nouvelle femme et gérez leurs informations.</p>
        <img src="asset/img/logo_mairie.png" alt="">
        
        <a href="{{ route('femmes.index') }}" class="btn btn-primary">Liste des Femmes</a>
        <a href="{{ route('femmes.create') }}" class="btn btn-success">Enregistrer une Femme</a>
        <a href="{{ route('femmes.edit', ['femme' => 1]) }}" class="btn btn-warning">Modifier Femme (ex ID 1)</a>
        <a href="{{ route('femmes.show', ['femme' => 1]) }}" class="btn btn-info">Voir Femme (ex ID 1)</a>

        <p style="font-size: 0.9rem; margin-top: 1rem; color: #ddd;">
            Lacs 1 un patrimoine à préserver!!!
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
