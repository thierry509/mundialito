<template>

    <Head>
        <title>Les Matchs de la compétition </title>
    </Head>
    <div class="p-6 md:p-8">

        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Liste des Matchs</h1>
            <p class="text-gray-600 mt-2">Affichage des rencontres et résultats (scores)</p>
        </div>

        <div class="flex justify-end mb-4">
            <button v-if="auth?.user.roles == 'admin'" @click="createMatch"
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
                            <h2 class="text-sm md:text-xl font-semibold text-gray-50">{{ gameStage(matchDays[0].stage)
                                }}</h2>
                            <span class="text-xs bg-white text-primary font-semibold px-2 py-1 rounded-full">{{
                                matchDays.length }}
                                matchs</span>
                        </div>
                    </div>

                    <!-- Liste des matchs -->
                    <template v-for="game in matchDays">
                        <SingleGame :game="game" :auth="auth" />
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
