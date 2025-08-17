<template>
    <div :id="game.id" class="divide- divide-gray-200 rounded-lg bg-white mb-2">
        <div class="p-4 hover:bg-gray-50/50 transition duration-200 rounded-lg shadow-[5px_5px_10px_0_rgba(7,7,7,0.1)]">
            <!-- En-tête avec date, statut et lieu -->
            <div class="flex justify-between items-center mb-3 text-xs text-gray-600">
                <div class="flex items-center space-x-2">
                    <span v-if="game.date_time"> {{ formatDate(game.date_time) }}</span>
                    <span v-else class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Non spécifié</span>
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
                <div class="flex items-center justify-end space-x-3  w-2/6 md:w-2/5 pr-2">
                    <div class="hidden md:d-block w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-xs font-bold text-primary">{{ game.team_a.name.slice(0, 2) }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-medium truncate">{{ game.team_a.name }}</span>
                </div>

                <!-- Score -->
                <div class="flex flex-col items-center w-2/6 md:w-1/5 py-1 p-2">
                    <div v-if="game.status != 'postponed' && game.team_a_goals != null" class="flex items-center my-1">
                        <span
                            class="h-8 rounded-md text-center flex items-center justify-center text-2xl font-bold transition-all">
                            <span v-if="game.shootout_score_a !== null" class="mx-2 text-sm">({{ game.shootout_score_a
                                }})</span>
                            {{
                                game.team_a_goals }}</span>
                        <span class="text-2xl font-medium text-gray-500 px-1">-</span>
                        <span
                            class="h-8 rounded-md text-center flex items-center justify-center text-2xl font-bold transition-all">{{
                                game.team_b_goals }}
                            <span v-if="game.shootout_score_b !== null" class="mx-2 text-sm">({{ game.shootout_score_b
                                }})</span>
                        </span>
                    </div>
                    <div v-else class="my-1">
                        <span class="font-bold">VS</span>
                    </div>
                </div>

                <!-- Équipe B -->
                <div class="flex items-center just justify-start space-x-3  w-2/6 md:w-2/5 pl-2">
                    <span class="text-xs md:text-sm font-medium truncate">{{ game.team_b.name }}</span>
                    <div class="hidden md:d-block w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-xs font-bold text-primary">{{ game.team_b.name.slice(0, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Section des boutons d'action -->
            <div class="flex justify-end space-x-2 mt-4 pt-3 border-t border-gray-100">
                <Link :href="`/edition/championnat/match/${game.id}`" v-if="game.status != 'postponed'"
                    style="justify-self: end !important;"
                    class="!justify-self-end px-3 py-1.5 text-xs font-medium rounded-md bg-primary text-white hover:bg-primary/90 transition flex justify-center">

                <svg class="h-4 w-4 inline text-white" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill="currentColor"
                            d="M600.704 64a32 32 0 0 1 30.464 22.208l35.2 109.376c14.784 7.232 28.928 15.36 42.432 24.512l112.384-24.192a32 32 0 0 1 34.432 15.36L944.32 364.8a32 32 0 0 1-4.032 37.504l-77.12 85.12a357.12 357.12 0 0 1 0 49.024l77.12 85.248a32 32 0 0 1 4.032 37.504l-88.704 153.6a32 32 0 0 1-34.432 15.296L708.8 803.904c-13.44 9.088-27.648 17.28-42.368 24.512l-35.264 109.376A32 32 0 0 1 600.704 960H423.296a32 32 0 0 1-30.464-22.208L357.696 828.48a351.616 351.616 0 0 1-42.56-24.64l-112.32 24.256a32 32 0 0 1-34.432-15.36L79.68 659.2a32 32 0 0 1 4.032-37.504l77.12-85.248a357.12 357.12 0 0 1 0-48.896l-77.12-85.248A32 32 0 0 1 79.68 364.8l88.704-153.6a32 32 0 0 1 34.432-15.296l112.32 24.256c13.568-9.152 27.776-17.408 42.56-24.64l35.2-109.312A32 32 0 0 1 423.232 64H600.64zm-23.424 64H446.72l-36.352 113.088-24.512 11.968a294.113 294.113 0 0 0-34.816 20.096l-22.656 15.36-116.224-25.088-65.28 113.152 79.68 88.192-1.92 27.136a293.12 293.12 0 0 0 0 40.192l1.92 27.136-79.808 88.192 65.344 113.152 116.224-25.024 22.656 15.296a294.113 294.113 0 0 0 34.816 20.096l24.512 11.968L446.72 896h130.688l36.48-113.152 24.448-11.904a288.282 288.282 0 0 0 34.752-20.096l22.592-15.296 116.288 25.024 65.28-113.152-79.744-88.192 1.92-27.136a293.12 293.12 0 0 0 0-40.256l-1.92-27.136 79.808-88.128-65.344-113.152-116.288 24.96-22.592-15.232a287.616 287.616 0 0 0-34.752-20.096l-24.448-11.904L577.344 128zM512 320a192 192 0 1 1 0 384 192 192 0 0 1 0-384zm0 64a128 128 0 1 0 0 256 128 128 0 0 0 0-256z">
                        </path>
                    </g>
                </svg>
                <span class="mx-1.5">Gestion du Match</span>
                </Link>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { Link, router, useForm } from '@inertiajs/vue3';
import { formatDate, gameStatus, statusClass } from '../../Utils/utils';


interface Game {
    id: number,
    team_a_goals: number
}
const props = defineProps({
    game: {
        type: Object,
        required: true
    },
    auth: Object,
})
</script>
