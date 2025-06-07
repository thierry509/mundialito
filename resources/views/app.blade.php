<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
  <head>
<meta name="robots" content="noindex, nofollow">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/mundialito.ico') }}" type="image/x-icon">
    @vite('resources/js/app.js')
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
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>
