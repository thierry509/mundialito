<template>
    <div class="flex flex-col bg-white rounded-lg w-60 p-1 text-sm cursor-pointer">
        <div v-if="game" class="px-1">
            <Link :href="`/edition/championnat/match?year=${year}#${game.id}`">
            <div class="flex justify-between">
                <span>{{ game.team_a?.name ?? 'N/A' }}</span>
                <span>{{ game.team_a_goals }} <span v-if="game.shootout_score_a != null" class="text-sm">({{
                    game.shootout_score_a }})</span>
                </span>
            </div>
            <div class="flex justify-between">
                <span>{{ game.team_b?.name ?? 'N/A' }}</span>
                <span>{{ game.team_b_goals }} <span v-if="game.shootout_score_b != null" class="text-sm">({{
                    game.shootout_score_b }})</span>
                </span>
            </div>
            </Link>
        </div>
        <div v-else-if="previousGame.length == 0 && firstRound" @click="createGame(position, stage)"
            class="flex justify-center items-center border-2 border-dotted border-gray-300 w-full rounded-lg py-2 px-4 hover:bg-gray-50 cursor-pointer transition-colors">
            <div class="flex items-center gap-2 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="font-medium">Planifier un match</span>
            </div>
        </div>
        <div v-else
            class="flex justify-center items-center border-2 border-dotted border-gray-300 w-full rounded-lg py-2 px-4">
            <div class="flex items-center gap-2 text-gray-500">
                <span class="font-medium">Match en attente</span>
            </div>
        </div>
    </div>

</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { useYearStore } from '../../store/year';
defineProps({
    teams: Array,
    game: Object,
    position: Number,
    stage: String,
    firstRound: Boolean,
    previousGame: {
        type: Array,
        default: []
    },
});

const year = useYearStore().year
const emit = defineEmits(['create']);

const createGame = (position, stage) => {
    emit('create', { position, stage });
}
</script>
