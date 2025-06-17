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
        <div class="h-full w-full relative shadow-xl border border-gray-200 overflow-hidden bg-gray-200 rounded-lg">
            <!-- Conteneur scrollable avec header fixe -->
            <div id="scrollableDiv"
                class="h-full w-full overflow-auto cursor-move scroll-smooth [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <!-- En-tête collant avec effet de profondeur -->
                <div class="sticky top-0 z-20 flex w-[1300px] bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg ">
                    @if ($round >= 4)
                        <div class="w-[300px] py-3 px-6 border-r border-blue-500 text-center shrink-0">
                            <span class="text-white font-semibold text-lg uppercase tracking-wider">Huitième de final</span>
                        </div>
                    @endif
                    @if ($round >= 3)
                        <div v-if="round >= 3" class="w-[300px] py-3 px-6 border-r border-blue-500 text-center shrink-0">
                            <span class="text-white font-semibold text-lg uppercase tracking-wider">Quart de final</span>
                        </div>
                    @endif

                    @if ($round >= 2)
                        <div v-if="round >= 2" class="w-[300px] py-3 px-6 border-r border-blue-500 text-center shrink-0">
                            <span class="text-white font-semibold text-lg uppercase tracking-wider">Demi-finale</span>
                        </div>
                    @endif

                    @if ($round >= 1)
                        <div v-if="round >= 1" class="w-[300px] py-3 px-6 text-center shrink-0">
                            <span class="text-white font-semibold text-lg uppercase tracking-wider">Finale</span>
                        </div>
                    @endif

                </div>


                <!-- Zone de tournoi avec fond subtil -->
                <div class="relative w-[1300px] h-[1000px]">
                    <!-- Canvas pour les lignes de connexion -->
                    <canvas id="diagram" class="absolute inset-0" width="1300" height="1000"></canvas>
                    <!-- Arbre de tournoi -->
                    <div id="knockout" class="absolute inset-0 flex items-center w-full h-full pl-4">
                        <!-- Colonne Huitièmes -->
                        @if ($round >= 4)
                            <div class="mr-[100px] ml-4">
                                @for ($i = 1; $i < 8 + 1; $i++)
                                    <x-single-match-knockout :game="$round16[$i]??null" class="my-[50px]" :position="$i"
                                        stage="round16" />
                                @endfor
                            </div>
                        @endif
                        <!-- Colonne Quarts -->
                        @if ($round >= 3)
                            <div class="mr-[100px]">
                                @for ($i = 1; $i < 4 + 1; $i++)
                                    <x-single-match-knockout :game="$quarter[$i]??null" class="my-[150px]" :position="$i"
                                        stage="quarter" />
                                @endfor
                            </div>
                        @endif

                        <!-- Colonne Demis -->
                        @if ($round >= 2)
                            <div class="mr-[100px]">
                                @for ($i = 1; $i < 2 + 1; $i++)
                                    <x-single-match-knockout :game="$semi[$i]??null" class="my-[350px]" :position="$i"
                                        stage="semi" />
                                @endfor
                            </div>
                        @endif

                        <!-- Colonne Finale -->
                        @if ($round >= 1)
                            <div class="mr-[100px]">
                                <x-single-match-knockout :game="$final[1]??null" class="my-[350px]" :position="0"
                                    stage="final" />
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- Indicateur de scroll (optionnel) -->
            <div class="absolute bottom-2 right-2 text-xs text-gray-400">
                ↖ Faites glisser pour naviguer
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


            let i = 1;
            if ({{ $round }} >= 4) {
                drawRound16(m, ctx, i);
                i++;
            }
            if ({{ $round }} >= 3) {
                drawQuarter(m, ctx, i);
                i++;
            }
            if ({{ $round }} >= 2) {
                drawSemi(m, ctx, i);
            }
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

        function getValueKnockout2(totalElements, currentPosition) {
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


        function getValueKnockout3(totalElements, currentPosition) {
            const sequences = {
                2: [-200, 200],
            };

            // Vérification des paramètres
            if (currentPosition < 1 || currentPosition > totalElements) return null;

            // Retourne la valeur correspondante
            return sequences[totalElements]?.[currentPosition - 1];
        }

        function drawRound16(m, ctx, n) {
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

        function drawQuarter(m, ctx, n) {
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

        function drawSemi(m, ctx, n) {
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
