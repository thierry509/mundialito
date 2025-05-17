@extends('layout.app')

@section('content')
    <style>
        .bracket-connector {
            position: relative;
        }

        .bracket-connector::after,
        .bracket-connector::before {
            content: '';
            position: absolute;
            background-color: #e5e7eb;
        }

        .bracket-connector::after {
            background: #e70000;
            width: 20px;
            height: 2px;
            top: 50%;
            right: -20px;
        }

        .bracket-connector::before {
            background: #3700ff;
            width: 20px;
            height: 2px;
            top: 50%;
            left: -3200px;
        }

        .bracket-connector.last-in-group::before {
            /* height: 50%; */
        }

        .bracket-connector.first-in-group::before {
            height: calc(50% + 20px);
            top: 0;
        }

        .bracket-connector.single-connector::before {
            height: 0;
        }
    </style>

    <!-- Hero Section -->
    <x-hero title="Phase à Élimination Directe" subtitle="Suivez le parcours des équipes vers la finale"
        backgroundImage="/images/stade-knockout.jpg" variant="primary" />

    <!-- Bracket Section -->
    <main class="container mx-auto px-4 py-12 flex flex-col items-center ">
        <div id="scrollableDiv"
            class="relative cursor-move h-full w-full overflow-auto [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <!-- Conteneur scrollable (prend la taille du parent) -->
            <!-- Conteneur interne avec une hauteur explicite (calculée) -->
            <div class="relative" :style="{ height: `${250 * count / 2}px`, width: '1300px' }">
                <!-- En-tête (position: absolute) -->
                <div class="absolute top-0 left-0 flex items-center w-full bg-primary shadow-md z-10">
                    <div class="w-[400px] py-3 px-6 border-r border-primary-light text-center">
                        <span class="text-white font-medium text-lg uppercase tracking-wider">Huitième de final</span>
                    </div>
                    <div class="w-[400px] py-3 px-6 border-r border-primary-light text-center">
                        <span class="text-white font-medium text-lg uppercase tracking-wider">Quart de final</span>
                    </div>
                    <div class="w-[400px] py-3 px-6 border-r border-primary-light text-center">
                        <span class="text-white font-medium text-lg uppercase tracking-wider">Demi-finale</span>
                    </div>
                    <div class="w-[400px] py-3 px-6 text-center">
                        <span class="text-white font-medium text-lg uppercase tracking-wider">Finale</span>
                    </div>
                </div>

                <!-- Canvas (position: absolute) -->
                <canvas id="diagram" class="absolute border top-0 left-0" width="1300"
                    :height="250 * count / 2"></canvas>

                <!-- Contenu knockout (position: absolute) -->
                <div id="knockout" class="absolute top-0 left-0 flex items-center w-full h-full">
                    <div class="mr-[100px]">
                        <template v-for="i in 8">
                            <singleMatchKnockout class="my-[50px]" />
                        </template>
                    </div>
                    <div class="mr-[100px]">
                        <template v-for="i in 4">
                            <singleMatchKnockout class="my-[150px]" />
                        </template>
                    </div>
                    <div class="mr-[100px]">
                        <template v-for="i in 2">
                            <singleMatchKnockout class="my-[350px]" />
                        </template>
                    </div>
                    <div class="mr-[100px]">
                        <template v-for="i in 1">
                            <singleMatchKnockout class="my-[350px]" />
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Légende -->
        <div class="mt-8 bg-white rounded-lg shadow p-4 max-w-2xl mx-auto">
            <h3 class="font-bold text-lg mb-2 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Légende
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-primary rounded-full"></div>
                    <span>Équipe victorieuse</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-100 rounded-full border border-gray-300"></div>
                    <span>Équipe éliminée</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-secondary rounded-full"></div>
                    <span>Champion</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 border-2 border-primary rounded-full"></div>
                    <span>Match en cours</span>
                </div>
            </div>
        </div>
    </main>

    <script>
        const count = 8;

        const n = 50;
        const m = (250 * count) / 4;
        const canvas = document.getElementById('diagram');
        if (canvas.getContext) {
            var ctx = canvas.getContext("2d");
            ctx.strokeStyle = 'rgb(255,255,255)';
            ctx.lineWidth = 3; // Épaisseur de 5px
            drawRound16(m, ctx, 1)
            drawQuarter(m, ctx, 2)
            drawSemi(m, ctx, 3)
        }


        const scrollableDiv = document.getElementById('scrollableDiv');

        let isDown = false;
        let startX, startY;
        let scrollLeft, scrollTop;

        scrollableDiv.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - scrollableDiv.offsetLeft;
            startY = e.pageY - scrollableDiv.offsetTop;
            scrollLeft = scrollableDiv.scrollLeft;
            scrollTop = scrollableDiv.scrollTop;
        });

        scrollableDiv.addEventListener('mouseleave', () => {
            isDown = false;
        });

        scrollableDiv.addEventListener('mouseup', () => {
            isDown = false;
        });

        scrollableDiv.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - scrollableDiv.offsetLeft;
            const y = e.pageY - scrollableDiv.offsetTop;
            const walkX = (x - startX) * 2; // Multiplicateur pour la vitesse horizontale
            const walkY = (y - startY) * 2; // Multiplicateur pour la vitesse verticale
            scrollableDiv.scrollLeft = scrollLeft - walkX;
            scrollableDiv.scrollTop = scrollTop - walkY;
        });



        function getValueKnockout(count, n) {
            // Vérification des paramètres
            if (n < 1 || n > count) return undefined;

            // Définition des séquences
            const sequences = {
                8: [-346, -246, -146, -50, 50, 146, 246, 346],
                4: [-146, -50, 50, 146],
                2: [-50, 50]
            };

            // Retourne la valeur correspondante
            return sequences[count]?.[n - 1];
        }

        getValueKnockout2(totalElements, currentPosition) {
            const sequences = {
                8: [-346, -246, 146, -50, 50, 146, 246, 346],
                4: [146, -50, 50, 146],
                2: [-50, 50],
                4: [-300, -100, 100, 300] // Nouvelle séquence pour 4 éléments
            };

            // Vérification des paramètres
            if (currentPosition < 1 || currentPosition > totalElements) return null;

            // Retourne la valeur correspondante
            return sequences[totalElements]?.[currentPosition - 1];
        }


        getValueKnockout3(totalElements, currentPosition) {
            const sequences = {
                2: [-200, 200],
            };

            // Vérification des paramètres
            if (currentPosition < 1 || currentPosition > totalElements) return null;

            // Retourne la valeur correspondante
            return sequences[totalElements]?.[currentPosition - 1];
        }

        export function drawRound16(m, ctx, n) {
            const count = 8;

            ctx.save();
            ctx.translate(0, 0)

            // ctx.beginPath();
            // ctx.moveTo(230, 0);
            // ctx.lineTo(330, m);
            // ctx.closePath();
            // ctx.stroke();

            for (let i = 1; i <= count; i++) {

                let p = getValueKnockout(count, i);
                console.log(p, i, count)
                ctx.beginPath();
                ctx.moveTo(230, m - p);
                ctx.lineTo(300, m - p);
                ctx.closePath();
                ctx.stroke();


                ctx.beginPath();
                ctx.moveTo(300, m - p);
                if (i % 2 != 0) {
                    ctx.lineTo(300, m - p - 50);
                } else {
                    ctx.lineTo(300, m - p + 50);
                }
                ctx.closePath();
                ctx.stroke()

                ctx.beginPath()
                if (i % 2 != 0) {

                    ctx.moveTo(300, m - p - 50);
                    ctx.lineTo(370, m - p - 50);
                }
                ctx.closePath();
                ctx.stroke();
            }
            ctx.restore(); // Restaure le contexte

        }

        export function drawQuarter(m, ctx, n) {
            const count = 4;

            ctx.save();
            if (n == 1) {
                ctx.translate(0, 0)
            } else if (n == 2) {
                ctx.translate(340, 0)
            }


            for (let i = 1; i <= count; i++) {

                let p = getValueKnockout2(count, i);
                ctx.beginPath();
                ctx.moveTo(230, m - p);
                ctx.lineTo(300, m - p);
                ctx.closePath();
                ctx.stroke();


                ctx.beginPath();
                ctx.moveTo(300, m - p);
                if (i % 2 == 0) {
                    ctx.lineTo(300, m - p + 150);
                } else {
                    ctx.lineTo(300, m - p - 150);
                }
                ctx.closePath();
                ctx.stroke()

                ctx.beginPath()
                if (i % 2 != 0) {

                    ctx.moveTo(300, m - p - 100);
                    ctx.lineTo(370, m - p - 100);
                }
                ctx.closePath();
                ctx.stroke();
            }
            ctx.restore(); // Restaure le contexte

        }

        export function drawSemi(m, ctx, n) {
            const count = 2;

            ctx.save();
            if (n == 1) {
                ctx.translate(0, 0)
            } else if (n == 2) {
                ctx.translate(340, 0)
            } else if (n == 3) {
                ctx.translate(680, 0)
            }


            ctx.moveTo(230, m - 200);
            ctx.lineTo(300, m - 200);
            ctx.closePath();
            ctx.stroke();

            ctx.moveTo(230, m + 200);
            ctx.lineTo(300, m + 200);
            ctx.closePath();
            ctx.stroke();


            for (let i = 1; i <= count; i++) {

                let p = getValueKnockout3(count, i);
                ctx.beginPath();
                ctx.moveTo(230, m - p);
                ctx.lineTo(300, m - p);
                ctx.closePath();
                ctx.stroke();


                ctx.beginPath();
                ctx.moveTo(300, m - p);
                if (i % 2 == 0) {
                    ctx.lineTo(300, m - p + 300);
                } else {
                    ctx.lineTo(300, m - p - 300);
                }
                ctx.closePath();
                ctx.stroke()

                ctx.beginPath()
                if (i % 2 != 0) {
                    ctx.moveTo(300, m - p - 200);
                    ctx.lineTo(370, m - p - 200);
                }
                ctx.closePath();
                ctx.stroke();
            }
            ctx.restore(); // Restaure le contexte

        }
    </script>
@endsection
