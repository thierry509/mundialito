<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mondialito - Championnat Vacance d'Été</title>
    @vite('resources/js/app.js')
    @hasSection('content')
    @else
        @inertiaHead
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#27AE60',
                        secondary: '#F4D03F',
                        accent: '#3498DB',
                        danger: '#E74C3C',
                        light: '#ECF0F1',
                    }
                }
            }
        }
    </script>
    <style>
        .navbar-transparent {
            background-color: transparent !important;
            transition: all 0.3s ease;
        }

        .navbar-solid {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="font-sans">
    @include('layout.partials.nav')

    @hasSection('content')
        @yield('content')
    @else
        @inertia
    @endif

    @include('layout.partials.footer')
