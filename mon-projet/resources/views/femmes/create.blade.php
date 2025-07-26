<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Enregistrer une nouvelle personne</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            background: white;
            border-radius: 1.25rem;
            max-width: 480px;
            width: 100%;
            padding: 2.5rem 2rem 3rem;
            box-shadow: 0 25px 50px -12px rgb(101 41 255 / 0.3);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 40px 80px -12px rgb(101 41 255 / 0.5);
        }

        h2 {
            font-weight: 700;
            font-size: 2rem;
            color: #4c1d95;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 0.05em;
        }

        .form-control {
            border-radius: 0.75rem !important;
            box-shadow: 0 2px 6px rgb(101 41 255 / 0.15);
            border: 1px solid #dcd6f7 !important;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 12px 3px rgb(101 41 255 / 0.6);
            border-color: #6b21a8 !important;
            outline: none;
        }

        .btn-submit {
            background: #7c3aed;
            color: white;
            font-weight: 600;
            font-size: 1.15rem;
            padding: 0.85rem;
            border-radius: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-submit:hover {
            background: #a78bfa;
            color: #3c096c;
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgb(167 139 250 / 0.6);
        }

        @media (max-width: 576px) {
            .card {
                padding: 2rem 1.5rem 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="card shadow-lg">
        <h2>Enregistrer une nouvelle personne</h2>
        <form method="POST" action="{{ route('femmes.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="mb-4">
                <input
                    type="text"
                    name="nom"
                    placeholder="Nom"
                    class="form-control"
                    required
                    autocomplete="off"
                />
                <div class="invalid-feedback">Le nom est requis.</div>
            </div>

            <div class="mb-4">
                <input
                    type="text"
                    name="prenom"
                    placeholder="Prénom"
                    class="form-control"
                    required
                    autocomplete="off"
                />
                <div class="invalid-feedback">Le prénom est requis.</div>
            </div>

            <div class="mb-4">
                <input
                    type="text"
                    name="activite"
                    placeholder="Activité"
                    class="form-control"
                    required
                    autocomplete="off"
                />
                <div class="invalid-feedback">L'activité est requise.</div>
            </div>

            <div class="mb-4">
                <input
                    type="tel"
                    name="telephone"
                    placeholder="Téléphone"
                    class="form-control"
                    required
                    pattern="^[0-9+\-\s]+$"
                    autocomplete="off"
                />
                <div class="invalid-feedback">Veuillez saisir un téléphone valide.</div>
            </div>

            <div class="mb-4">
                <label for="sexe" class="form-label">Sexe</label>
                <select name="sexe" id="sexe" class="form-control" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="femme" selected>Femme</option>
                    <option value="homme">Homme</option>
                </select>
                <div class="invalid-feedback">Le sexe est requis.</div>
            </div>

            <button type="submit" class="btn btn-submit w-100">Enregistrer</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Bootstrap validation script
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>
