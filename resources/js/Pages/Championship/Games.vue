<template>

    <Head>
        <title>Les Matchs de la compétition </title>
    </Head>
    <div class="p-6 md:p-8">

        <div class="flex flex-col gap-4 mb-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <g stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />
                            <path d="M20.586 3.586a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </g>
                    </svg>
                    <span class="border-l-2 border-primary pl-3">Les Matchs
                        <span class="text-primary font-semibold">de la compétition</span>
                    </span>
                </h1>
            </div>
        </div>

        <div class="flex justify-end my-4">
            <button v-if="auth?.user.roles == 'admin'"@click="createMatch"
                class="px-4 py-2 mt-4 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                Ajouter un match
            </button>
        </div>
        <div v-if="games.length === 0" class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <EmptyView model="match">
                <button v-if="auth?.user.roles == 'admin'" @click="createMatch"
                    class="px-4 py-2 mt-4 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                    Ajouter un match
                </button>
            </EmptyView>
        </div>

        <div v-for="matchDays in games" :key="matchDays?.id">
            <div class="space-y-6 my-6">
                <!-- Journée 1 -->
                <div class="bg-primary rounded-lg shadow-lg overflow-hidden px-2">
                    <!-- En-tête de journée -->
                    <div class="py-2">
                        <div class="flex justify-between items-center">
                            <h2 class="text-sm md:text-xl font-semibold text-gray-50">{{ gameStage(matchDays[0].stage) }}</h2>
                            <span class="text-xs bg-white text-primary font-semibold px-2 py-1 rounded-full">{{ matchDays.length }}
                                matchs</span>
                        </div>
                    </div>

                    <!-- Liste des matchs -->
                    <template v-for="game in matchDays">
                        <SingleGame :game="game" :auth="auth"/>
                    </template>
                </div>
            </div>
        </div>
        <CreateGame :show="showCreateGame" type="group" :groups="groups" @close="showCreateGame = false" />
    </div>
</template>

<script setup>
import EmptyView from '../../components/ui/EmptyView.vue'
import CreateGame from '../../components/modal/CreateGame.vue';
import SingleGame from '../../components/Championship/SingleGame.vue';
import { gameStage } from '../../Utils/utils';
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    games: {
        type: Array,
        default: () => []
    },
    groups: {
        type: Array,
        default: () => []
    },
    auth: Object,
})
const showCreateGame = ref(false);

const createMatch = () => {
    showCreateGame.value = true;
}
</script>
