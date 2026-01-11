<!DOCTYPE html>
<html lang="es">
    <head>
        <script>
            const BASE_URL = "{{ base }}";
        </script>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="{{ description }}" />
        <meta name="author" content="{{ author }}" />
        <title>{{ titulo }}</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ base }}/assets/favicon.ico" />

        <!-- Font Awesome icons -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" />

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="{{ base }}/node_modules/bootstrap-icons/font/bootstrap-icons.css">

        <!-- Core theme CSS -->
        <link href="{{ base }}/assets/plantilla/css/styles.css" rel="stylesheet" />
        <link href="{{ base }}/css/estilos.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <div id="loading">
            <img src="{{ base }}/img/loading.gif" alt="Cargando..." width="50">
        </div>

        <div class="modal fade" id="ventanaModal" tabindex="-1" aria-labelledby="ventanaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ventanaModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="contenidoVentanaModal">...</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button style="display:none" type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>