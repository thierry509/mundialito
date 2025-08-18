<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {!! SEO::generate() !!}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/mundialito.ico') }}" type="image/x-icon">
    <title>Mundialito - Championnat Vacance d'Été</title>
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
    <script type="module" src="/proxy-composant"></script>

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            const yearSelect = document.querySelector('#selectYear');
            const storageKey = 'year-store';
            try {
                // Récupérer l'année stockée
                const store = sessionStorage.getItem(storageKey);
                const storedYear = JSON.parse(store)?.year;


                if (storedYear) {
                    if (yearSelect) yearSelect.value = storedYear;
                } else {
                    sessionStorage.setItem(storageKey, JSON.stringify({
                        year: {{ $years[0] }}
                    }));
                    if (yearSelect) yearSelect.value = $years[0];

                }

                if (yearSelect) {
                    // Gérer le changement de sélection
                    yearSelect.addEventListener('change', function() {
                        if (this.value) {
                            sessionStorage.setItem(storageKey, JSON.stringify({
                                year: this.value
                            }));
                            const url = new URL(window.location.href);
                            url.searchParams.set('year', this.value);
                            window.location.href = url.toString();
                        }
                    });
                }
            } catch (e) {
                console.error('Erreur avec sessionStorage:', e);
            }
        });
    </script>

    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- Matomo -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u = "//analytics.desirthierry.net/";
            _paq.push(['setTrackerUrl', u + 'matomo.php']);
            _paq.push(['setSiteId', '1']);
            var d = document,
                g = d.createElement('script'),
                s = d.getElementsByTagName('script')[0];
            g.async = true;
            g.src = u + 'matomo.js';
            s.parentNode.insertBefore(g, s);
        })();
    </script>
    <!-- End Matomo Code -->
    @vite(['resources/js/index.js'])
</head>

<body class="font-sans">
    @guest
        <div id="g_id_onload" data-client_id="{{ env('GOOGLE_CLIENT_ID') }}" data-callback="handleGoogleSignIn"
            data-auto_prompt="true">
        </div>
    @endguest
    @include('layout.partials.nav')

    @hasSection('content')
        <thierry-banner type="sticky"></thierry-banner>
        @yield('content')
    @else
        @inertia
    @endif
    <script>
      
        function handleGoogleSignIn(response) {
            if (!response.credential) {
                console.error("Pas de credential reçu");
                return;
            }
            const token = response.credential;
            console.log("Google ID Token:", token);

            axios.post('/google/rappel', {
                    token
                })
                .then(res => window.location.reload())
                .catch(err => console.error(err));
        }

        // Optionnel : afficher un bouton classique en fallback
        window.onload = function() {
            google.accounts.id.renderButton(
                document.getElementById("google-login-button"), {
                    theme: "outline",
                    size: "large"
                }
            );
        };
    </script>
    @include('layout.partials.footer')
