<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>QR Code Generator with Download</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body>
    <div class="container text-center mt-4">
        <h1>QR Code généré pour {{ $femme->prenom ?? '' }} {{ $femme->nom ?? '' }}</h1>
        <div class="row justify-content-center mt-3">
            <div class="col-md-4">
                <div id="container">
                    {!! $simple !!}
                </div>
                <button class="btn btn-info mt-3 text-light" onclick="downloadSVG()">Télécharger SVG</button>
            </div>
        </div>
    </div>

    <script>
        function downloadSVG() {
            const svg = document.getElementById('container').innerHTML;
            const blob = new Blob([svg.toString()], { type: "image/svg+xml" });
            const element = document.createElement("a");
            element.download = "qrcode_femme.svg";
            element.href = URL.createObjectURL(blob);
            element.click();
            element.remove();
        }
    </script>
</body>
</html>
