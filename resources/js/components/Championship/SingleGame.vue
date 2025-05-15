<template>

    <div class="divide-y divide-gray-200">
        <div class="p-4 hover:bg-gray-50/50 transition duration-200 rounded-lg shadow-[5px_5px_10px_0_rgba(7,7,7,0.1)]">
            <!-- En-tête avec date, statut et lieu -->
            <div class="flex justify-between items-center mb-3 text-xs text-gray-600">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ formatDate(game.date_time) }}</span>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-medium">{{ game.location || 'Stade Principal' }}</span>
                    </div>

                    <span class="px-2 py-1 bg-primary/10 text-primary text-xs font-semibold rounded-full">
                        {{ gameStatus(game.status) }}
                    </span>
                </div>
            </div>

            <!-- Contenu du match -->
            <div class="flex items-center justify-between py-2">
                <!-- Équipe A -->
                <div class="flex items-center space-x-3 w-2/5">
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-xs font-bold text-primary">{{ game.team_a.name.slice(0, 2) }}</span>
                    </div>
                    <span class="text-sm font-medium truncate">{{ game.team_a.name }}</span>
                </div>

                <!-- Score -->
                <div class="flex flex-col items-center w-1/5">
                    <div class="flex items-center my-1 space-x-2">
                        <input v-model="score.teamAGoal" type="number"
                            class="w-12 h-8 rounded-md text-center outline-none text-sm font-bold bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary/30 transition-all"
                            min="0" max="99" maxlength="2" placeholder="0" />

                        <span class="text-sm font-medium text-gray-500">-</span>

                        <input v-model="score.teamBGoal" type="number"
                            class="w-12 h-8 rounded-md text-center outline-none text-sm font-bold bg-white border border-gray-200 focus:border-primary focus:ring-1 focus:ring-primary/30 transition-all"
                            min="0" max="99" maxlength="2" placeholder="0" />
                    </div>
                </div>

                <!-- Équipe B -->
                <div class="flex items-center justify-end space-x-3 w-2/5">
                    <span class="text-sm font-medium truncate">{{ game.team_b.name }}</span>
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-xs font-bold text-primary">{{ game.team_b.name.slice(0, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Section des boutons d'action -->
            <div class="flex justify-between space-x-2 mt-4 pt-3 border-t border-gray-100">

                <button v-if="!game?.team_a_goals" @click="deleteGame"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-red-500/10 text-red-500 hover:bg-red-500/20 transition inline-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Suprimmer
                </button>
                <button
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-primary/10 text-primary hover:bg-primary/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Terminer
                </button>

                <button @click="updateScore"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-primary text-white hover:bg-primary/90 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Mettre à jour
                </button>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import { formatDate, gameStatus } from '../../Utils/utils';
import { useToasterStore } from '../../store/Toast';
import { useConfirmStore } from '../../store/confirmStore';

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
        title: 'Suppression',
        message: 'Voulez-vous vraiment supprimer cet élément ?',
        confirmText: 'Oui, supprimer',
        cancelText: 'Non, annuler'
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
        title: 'Mise-a-jour score',
        message: `Voulez-vous vraiment mettre a jour ce match les score <strong> ${props.game.team_a.name} : ${score.teamAGoal} et ${props.game.team_a.name} : ${score.teamBGoal}`
    });
    score.put('', {
        onSuccess: () => {
            useToasterStore().success({ text: 'Score mise a jour' })
        }
    })
}
</script>
