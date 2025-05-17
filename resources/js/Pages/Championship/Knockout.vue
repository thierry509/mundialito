<template>

    <Head>
        <title>Phase a elimination</title>
    </Head>
    <pre>
        {{ games }}
    </pre>

    <div class="h-full w-full relative bg-white shadow-xl border border-gray-200 overflow-hidden">
  <!-- Conteneur scrollable avec header fixe -->
  <div id="scrollableDiv" class="h-full w-full overflow-auto cursor-move scroll-smooth [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
    <!-- En-tête collant avec effet de profondeur -->
    <div class="sticky top-0 z-20 flex w-[1300px] bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
      <div class="w-[300px] py-3 px-6 border-r border-blue-500 text-center shrink-0">
        <span class="text-white font-semibold text-lg uppercase tracking-wider">Huitième de final</span>
      </div>
      <div class="w-[300px] py-3 px-6 border-r border-blue-500 text-center shrink-0">
        <span class="text-white font-semibold text-lg uppercase tracking-wider">Quart de final</span>
      </div>
      <div class="w-[300px] py-3 px-6 border-r border-blue-500 text-center shrink-0">
        <span class="text-white font-semibold text-lg uppercase tracking-wider">Demi-finale</span>
      </div>
      <div class="w-[300px] py-3 px-6 text-center shrink-0">
        <span class="text-white font-semibold text-lg uppercase tracking-wider">Finale</span>
      </div>
    </div>

    <!-- Zone de tournoi avec fond subtil -->
    <div :class="`relative w-[1300px] h-[${250 * count / 2}px] bg-gray-200`">
      <!-- Canvas pour les lignes de connexion -->
      <canvas id="diagram"
              class="absolute inset-0"
              width="1300"
              :height="250 * count / 2"></canvas>

      <!-- Arbre de tournoi -->
      <div id="knockout" class="absolute inset-0 flex items-center w-full h-full">
        <!-- Colonne Huitièmes -->
        <div class="mr-[100px] ml-4">
          <template v-for="i in 8">
            <singleMatchKnockout :position="i" stage='round16' @create="createGame" class="my-[50px] hover:scale-105 transition-transform" />
          </template>
        </div>

        <!-- Colonne Quarts -->
        <div class="mr-[100px]">
          <template v-for="i in 4">
            <singleMatchKnockout :position="i" stage='quarter' @create="createGame" class="my-[150px] hover:scale-105 transition-transform" />
          </template>
        </div>

        <!-- Colonne Demis -->
        <div class="mr-[100px]">
          <template v-for="i in 2">
            <singleMatchKnockout :position="i" stage='semi' @create="createGame" class="my-[350px] hover:scale-105 transition-transform" />
          </template>
        </div>

        <!-- Colonne Finale -->
        <div class="mr-[100px]">
          <template v-for="i in 1">
            <singleMatchKnockout :position="i" stage='final' @create="createGame" class="my-[350px] hover:scale-105 transition-transform" />
          </template>
        </div>
      </div>
    </div>
  </div>

  <!-- Indicateur de scroll (optionnel) -->
  <div class="absolute bottom-2 right-2 text-xs text-gray-400">
    ↖ Faites glisser pour naviguer
  </div>
  <CreateKnockoutGame v-if="showCreate" :show="showCreate" :teams="teams" type="knockout" :stage="stage" :position="position" @close="showCreate = false"/>
</div>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import '../../../css/knockout.css'
import singleMatchKnockout from '../../components/Championship/singleMatchKnockout.vue';
import { parse } from 'marked';
import { drawQuarter, drawRound16, drawSemi } from '../../Utils/utils';
import CreateKnockoutGame from '../../components/modal/CreateKnockoutGame.vue';

const props = defineProps({
    teams: Object,
    games: Array,
})

const position = ref(null);
const stage = ref('')
const showCreate = ref(false)
const createGame = (payload) => {
    position.value = payload.position
    stage.value = payload.stage
    showCreate.value = true
}







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
