@extends('layouts.dashboardTemplate')
@section('content')
<div id="pdfViewer"></div>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>
        function afficherPDF(urlDuDocument) {
            var container = document.getElementById("pdfViewer");

    // Initialiser le PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://mozilla.github.io/pdf.js/build/pdf.worker.js";

        // Charger le document PDF
        pdfjsLib.getDocument(urlDuDocument).then(function (pdfDocument) {
        // Initialiser la première page
        pdfDocument.getPage(1).then(function (page) {
            // Définir l'échelle de la page
            var scale = 1.5;

            // Créer un canvas pour afficher la page
            var canvas = document.createElement("canvas");
            container.appendChild(canvas);

            // Définir les dimensions du canvas
            var viewport = page.getViewport({ scale: scale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Rendre la page sur le canvas
            var context = canvas.getContext("2d");
            var renderContext = {
            canvasContext: context,
            viewport: viewport,
            };
            page.render(renderContext);
        });
        });
    }
            afficherPDF("{{ $pdfUrl }}");
    </script>
@endsection