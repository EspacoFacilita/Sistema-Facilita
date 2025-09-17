<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Facilita</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
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

<body data-usertype="{{ Auth::user()->usertype }}" class="antialiased">
    <div class="flex min-h-screen bg-gray-100 ">
        @include('layouts.sidebar')
        <!-- Page Content -->
        <main class="ml-64 flex-1 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
