<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Facilita</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        @media print {

            aside,
            .no-print {
                display: none !important;
                /* esconde sidebar e outros elementos */
            }

            main {
                margin-left: 0 !important;
                /* remove o ml-64 só na impressão */
                width: 100% !important;
            }

            body,
            html {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .p-6,
            .bg-white {
                box-shadow: none !important;
                border-radius: 0 !important;
            }
        }

        body {
            font-family: 'Nunito', sans-serif;
        }

        a {
            text-decoration: none
        }

        ion-icon {
            --ionicon-stroke-width: 48px;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</body>

</html>
