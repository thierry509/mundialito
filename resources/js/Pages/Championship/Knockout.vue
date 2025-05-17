<template>

    <Head>
        <title>Phase a elimination</title>
    </Head>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white inline-flex items-center">
            <svg class="w-8 h-8 mr-3 p-1.5 bg-primary/10 text-primary rounded-full" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <g stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />
                    <path d="M20.586 3.586a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </g>
            </svg>
            <span class="border-l-2 border-primary pl-3">Phase a
                <span class="text-primary font-semibold">Elimination direct</span>
            </span>
        </h1>
    </div>
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
            <canvas id="diagram" class="absolute border top-0 left-0" width="1300" :height="250 * count / 2"></canvas>

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

</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import '../../../css/knockout.css'
import singleMatchKnockout from '../../components/Championship/singleMatchKnockout.vue';
import { parse } from 'marked';
import { drawQuarter, drawRound16, drawSemi } from '../../Utils/utils';
defineProps({
    year: Number
})



const count = 8;
onMounted(() => {
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

})

</script>
