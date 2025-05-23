<template>
    <div :id="game.id" class="divide- divide-gray-200 rounded-lg bg-white mb-2">
        <div class="p-4 hover:bg-gray-50/50 transition duration-200 rounded-lg shadow-[5px_5px_10px_0_rgba(7,7,7,0.1)]">
            <!-- En-tête avec date, statut et lieu -->
            <div class="flex justify-between items-center mb-3 text-xs text-gray-600">
                <div class="flex items-center space-x-2">
                    <span v-if="game.date_time"> {{ formatDate(game.date_time) }}</span>
                    <span v-else>à déterminer</span>
                </div>

                <div class="flex items-center space-x-3">
                    <!-- <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-medium">{{ game.location || 'Stade Principal' }}</span>
                    </div> -->

                    <span class="px-2 py-1 text-xs font-semibold rounded-full capitalize"
                        :class="statusClass(game.status)">
                        {{ gameStatus(game.status) }}
                    </span>
                </div>
            </div>

            <!-- Contenu du match -->
            <div class="flex items-center justify-between py-2">
                <!-- Équipe A -->
                <div class="flex items-center justify-end space-x-3 w-2/5 pr-2">
                    <div class="hidden md:d-block w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-xs font-bold text-primary">{{ game.team_a.name.slice(0, 2) }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-medium truncate">{{ game.team_a.name }}</span>
                </div>

                <!-- Score -->
                <div class="flex flex-col items-center w-1/5 py-1 p-2">
                    <div v-if="game.status != 'postponed'" class="flex items-center my-1">
                        <input v-model="score.teamAGoal" type="number"
                            class="w-8 md:w-12 h-8 rounded-md text-center outline-none text-sm font-bold bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary/30 transition-all"
                            min="0" max="99" maxlength="2" placeholder="0" />

                        <span class="text-sm font-medium text-gray-500">-</span>

                        <input v-model="score.teamBGoal" type="number"
                            class="w-8 md:w-12 h-8 rounded-md text-center outline-none text-sm font-bold bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary/30 transition-all"
                            min="0" max="99" maxlength="2" placeholder="0" />
                    </div>
                    <div v-else class="my-1">
                        <span class="font-bold">VS</span>
                    </div>
                </div>

                <!-- Équipe B -->
                <div class="flex items-center just justify-start space-x-3  w-2/5 pl-2">
                    <span class="text-xs md:text-sm font-medium truncate">{{ game.team_b.name }}</span>
                    <div class="hidden md:d-block w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-xs font-bold text-primary">{{ game.team_b.name.slice(0, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Section des boutons d'action -->
            <div v-if="game.status != 'finished'"
                class="flex justify-between space-x-2 mt-4 pt-3 border-t border-gray-100">

                <button v-if="!game?.team_a_goals" @click="deleteGame"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-red-500/10 text-red-500 hover:bg-red-500/20 transition flex flex-col md:flex-row justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span class="hidden md:block mx-1.5">Suprimmer</span>
                </button>

                <button v-if="game.status != 'postponed' && !game?.team_a_goals" @click="postpone"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-orange-500/10 text-orange-600 hover:bg-orange-500/20 transition inline-flex items-center justify-center">
                    <svg fill="currentColor" viewBox="0 0 36 36" version="1.1" class="h-4 w-4"
                        preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <title>redo-line</title>
                            <path
                                d="M24,4.22a1,1,0,0,0-1.41,1.42l5.56,5.49h-13A11,11,0,0,0,10.07,32,1,1,0,0,0,11,30.18a9,9,0,0,1-5-8,9.08,9.08,0,0,1,9.13-9h13l-5.54,5.48A1,1,0,0,0,24,20l8-7.91Z"
                                class="clr-i-outline clr-i-outline-path-1"></path>
                            <rect x="0" y="0" width="36" height="36" fill-opacity="0"></rect>
                        </g>
                    </svg>
                    <span class="hidden md:block mx-1.5">Reporter</span>
                </button>
                <button v-if="game.status == 'postponed'" @click="unpostpone"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-blue-500/10 text-blue-600 hover:bg-blue-600/20 transition inline-flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13l-3 3m0 0l-3-3m3 3V8" />
                    </svg>
                    <span class="hidden md:block mx-1.5">Replanifier</span>
                </button>

                <button v-if="game.team_a_goals != null && game.team_b_goals != null" @click="end"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-primary/10 text-primary hover:bg-primary/20 transition flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="hidden md:block mx-1.5"> Terminer</span>
                </button>

                <button v-if="game.status != 'postponed' && game.status != 'live'" @click="live"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-primary/10 text-primary hover:bg-primary/20 transition flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline animate-pulse" viewBox="0 0 24 24"
                        fill="currentColor">
                        <circle cx="12" cy="12" r="8" fill="red" />
                    </svg>
                    <span class="hidden md:block mx-1.5">En direct</span>
                </button>

                <button v-if="game.status != 'postponed'" @click="updateScore"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-primary text-white hover:bg-primary/90 transition flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span class="hidden md:block mx-1.5"> Mettre à jour</span>
                </button>
            </div>
        </div>
    </div>
    <UnpostponeGame :show="showUnpostpone" :game="game" @close="showUnpostpone = false" />
</template>
<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import { formatDate, gameStatus, statusClass } from '../../Utils/utils';
import { useToasterStore } from '../../store/Toast';
import { useConfirmStore } from '../../store/confirmStore';
import UnpostponeGame from '../modal/UnpostponeGame.vue';
import { ref } from 'vue';
import { route } from 'ziggy-js';

interface Game {
    id: number,
    team_a_goals: number
}
const props = defineProps({
    game: {
        type: Object,
        required: true
    }
})

const score = useForm({
    gameId: props.game.id,
    teamAGoal: props.game.team_a_goals,
    teamBGoal: props.game.team_b_goals,
});

const confirm = useConfirmStore();

const deleteGame = async () => {
    const isConfirmed = await confirm.show({
        title: 'Confirmation de suppression',
        message: 'Attention : la suppression entraînera la perte définitive des données.',
    })
    if (isConfirmed) {
        router.delete(`/edition/championnat/match/supprimer/${props.game.id}`, {
            onSuccess: () => {
                useToasterStore().success({ text: 'Match supprimer' })
            }
        });
    }
}

const updateScore = async () => {
    const isConfirmed = await confirm.show({
        title: 'Mise à jour du score',
        message: `Souhaitez-vous enregistrer le nouveau score du match ${props.game.team_a.name} contre ${props.game.team_b.name} ?`
    });
    if (isConfirmed) {
        score.put('', {
            onSuccess: () => {
                useToasterStore().success({ text: 'Score mise a jour' })
            }
        })
    }
}

const postpone = async () => {
    const isConfirmed = await confirm.show({
        title: "Reporter le match",
        message: `Le match ${props.game.team_a.name} - ${props.game.team_b.name} sera reporté. Confirmez-vous cette décision ?`
    })

    if (isConfirmed) {
        router.put(`/edition/championnat/match/reporte/${props.game.id}`, {},
            {
                onSuccess: () => {
                    useToasterStore().success({ text: 'Match Repoter' })
                }
            }
        );
    }
}

const live = async () => {
    const isConfirmed = await confirm.show({
        title: "Match en cours",
        message: `Voulez-vous marquer le match ${props.game.team_a.name} vs ${props.game.team_b.name} comme étant en cours ?`,
    })

    if (isConfirmed) {
        router.put(`/edition/championnat/match/en-direct/${props.game.id}`, {},
            {
                onSuccess: () => {
                    useToasterStore().success({ text: 'Match Repoter' })
                }
            }
        );
    }
}



const showUnpostpone = ref(false);

const unpostpone = () => {
    showUnpostpone.value = true
}

const end = async () => {
    const isConfirmed = await confirm.show({
        title: "Marquer le match comme terminé",
        message: `Cette action enregistrera le score final et clôturera le match. Confirmez-vous ?`
    })

    if (isConfirmed) {
        router.put(`/edition/championnat/match/terminer/${props.game.id}`, {}, {
            onSuccess: () => {
                useToasterStore().success({ text: 'Match Marqur comme terminer' })
            }
        })
    }
}


</script>
