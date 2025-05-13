<style>
.form-badge {
    background: linear-gradient(135deg, #27AE60 0%, #3498DB 100%);
}

.team-input {
    transition: all 0.2s;
}

.team-input:focus {
    box-shadow: 0 0 0 2px rgba(39, 174, 96, 0.2);
}
</style>
<template>
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-12">
        <!-- Titre Poule -->

        <div class="bg-accent text-white p-4 flex justify-between items-center">
            <div class="">
                <h2 class="text-xl font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    {{ group.name }} - Classement
                </h2>
                <div class="text-sm opacity-90 mt-1">Mis à jour le </div>
            </div>
            <div class="flex justify-end">
                <button v-if="group.teams.length <= 0" @click="removeGroup(group.id)"
                    class="opacity-100 text-white hover:text-danger transition bg-gray-200 bg-opacity-50 p-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="bg-white">
            <div class="overflow-y-hidden h-fit">
                <table class="w-full">
                    <thead class="bg-light/50">
                        <tr>
                            <th class="p-3 text-left w-8">#</th>
                            <th class="p-3 text-left min-w-[200px]">Équipe</th>
                            <th class="p-3 text-center">PTS</th>
                            <th class="p-3 text-center">J</th>
                            <th class="p-3 text-center">V</th>
                            <th class="p-3 text-center">N</th>
                            <th class="p-3 text-center">D</th>
                            <th class="p-3 text-center">BP</th>
                            <th class="p-3 text-center">BC</th>
                            <th class="p-3 text-center">+/-</th>
                            <th class="p-3 text-center">Forme</th>
                            <th class="p-3 text-center w-12"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-light">
                        <!-- Équipes existantes -->
                        <tr v-for="(team, index) in teamGroupes" :key="team.id" class="hover:bg-light/30 group">
                            <td class="p-3 font-bold" :class="{ 'text-primary': index === 0 }">{{ index + 1 }}</td>
                            <td class="p-3">
                                <div class="flex items-center">

                                    <span>{{ team.name }}</span>
                                </div>
                            </td>
                            <td class="p-3 text-center font-bold">{{ team.points }}</td>
                            <td class="p-3 text-center">{{ team.played }}</td>
                            <td class="p-3 text-center">{{ team.wins }}</td>
                            <td class="p-3 text-center">{{ team.draws }}</td>
                            <td class="p-3 text-center">{{ team.losses }}</td>
                            <td class="p-3 text-center">{{ team.goalsFor }}</td>
                            <td class="p-3 text-center">{{ team.goalsAgainst }}</td>
                            <td class="p-3 text-center font-bold"
                                :class="{ 'text-primary': team.goalDifference > 0, 'text-danger': team.goalDifference < 0 }">
                                {{ team.goalDifference > 0 ? '+' : '' }}{{ team.goalDifference }}
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center space-x-1">
                                    <span v-for="(result, i) in team.lastResults" :key="i" class="w-3 h-3 rounded-full"
                                        :class="{ 'bg-green-500': result === 'W', 'bg-yellow-500': result === 'D', 'bg-red-500': result === 'L' }">
                                    </span>
                                </div>
                            </td>
                            <td class="p-3 text-center">
                                <button @click="removeTeam(team.id)"
                                    class="opacity-0 group-hover:opacity-100 text-gray-400 hover:text-danger transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>

                        <!-- Nouvelle équipe -->
                        <tr v-if="addingTeam" class="bg-primary/5">
                            <td class="p-3 font-bold text-gray-400">{{ teamGroupes.length + 1 }}</td>
                            <td class="p-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <span class="font-bold text-gray-600">N</span>
                                    </div>
                                    <DropdownInput v-model="newTeam.team_id"
                                        :options="[...teams.map(team => ({ value: team.id, label: team.name }))]" />
                                </div>
                            </td>
                            <td class="p-3 text-center font-bold text-gray-400">0</td>
                            <td class="p-3 text-center text-gray-400">0</td>
                            <td class="p-3 text-center text-gray-400">0</td>
                            <td class="p-3 text-center text-gray-400">0</td>
                            <td class="p-3 text-center text-gray-400">0</td>
                            <td class="p-3 text-center text-gray-400">0</td>
                            <td class="p-3 text-center text-gray-400">0</td>
                            <td class="p-3 text-center font-bold text-gray-400">0</td>
                            <td class="p-3 text-center text-gray-400">-</td>
                            <td class="p-3 text-center">
                                <button @click="addTeam" class="text-primary hover:text-primary-dark transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bouton Ajouter -->
            <div class="p-4 border-t border-light flex justify-center">
                <button @click="startAddingTeam" v-if="!addingTeam"
                    class="flex items-center px-4 py-2 rounded-full form-badge text-white shadow-md hover:shadow-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Ajouter une équipe
                </button>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { ref, nextTick, computed, onMounted } from 'vue';
import DropdownInput from '../Form/DropdownInput.vue';
import { router, useForm } from '@inertiajs/vue3';
const props = defineProps({
    teams: {
        type: Array,
        default: () => []
    },
    group: {
        type: Object,
        default: () => ({})
    }
});

interface Team {
    id: number;
    name: string;
    color: string;
    initials: string;
    points: number;
    played: number;
    wins: number;
    draws: number;
    losses: number;
    goalsFor: number;
    goalsAgainst: number;
    goalDifference: number;
    lastResults: string[];
}


const addingTeam = ref(false);
const teamGroupes = computed(() => {
    return props.group.teams.map((team: Team) => ({
        id: team.id,
        name: team.name,
        color: team.color || 'gray',
        initials: team.initials || team.name.charAt(0).toUpperCase(),
        points: team.points || 0,
        played: team.played || 0,
        wins: team.wins || 0,
        draws: team.draws || 0,
        losses: team.losses || 0,
        goalsFor: team.goalsFor || 0,
        goalsAgainst: team.goalsAgainst || 0,
        goalDifference: team.goalDifference || 0,
        lastResults: team.lastResults || []
    }));
});

const newTeam = useForm({
    team_id: null,
    group_id: props.group.id,
});

const startAddingTeam = () => {
    addingTeam.value = true;

};

const addTeam = () => {
    console.log('Ajouter une équipe:', newTeam.team_id);
    newTeam.post('/edition/championnat/groupes/ajouter-equipe', {
        preserveScroll: true,
        onSuccess: () => {
            newTeam.reset()
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors)
        }
    })
    addingTeam.value = false;
};

const removeTeam = (id) => {
    if (confirm('Supprimer cette équipe ?')) {
        router.delete(`/edition/championnat/groupes/supprimer-equipe/${props.group.id}/${id}`, {
            preserveScroll: true,
            onSuccess: () => {
                console.log('Équipe supprimée avec succès');
            },
            onError: (errors) => {
                console.log('Erreur lors de la suppression de l\'équipe:', errors);
            }
        });
    }
};

const removeGroup = (id) => {
    if (confirm('Supprimer ce groupe ?')) {
        router.delete(`/edition/championnat/groupes/supprimer/${id}`, {
            preserveScroll: true,
            onSuccess: () => {
                console.log('Groupe supprimé avec succès');
            },
            onError: (errors) => {
                console.log('Erreur lors de la suppression du groupe:', errors);
            }
        });
    }
};


</script>