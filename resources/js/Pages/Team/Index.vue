<style>
.team-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>

<template>

    <Head>
        <title>Gestion des Équipes</title>
    </Head>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900">Gestion des Équipes</h1>
        <!-- Header -->
        <div class="flex justify-end items-center mb-10">
            <button @click="showForm = !showForm"
                class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ showForm ? 'Annuler' : 'Nouvelle Équipe' }}
            </button>
        </div>

        <CreateTeam :show="showForm" @close="showForm = false" />

        <!-- Liste des équipes -->
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Liste des équipes</h2>

            <div>
                <div v-if="teams.length === 0" class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <EmptyView model="équipe">
                        <button @click="showForm = true"
                            class="px-4 py-2 mt-4 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                            Ajouter une Équipe
                        </button>
                    </EmptyView>
                </div>

                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="team in teams" :key="team.id"
                        class="team-card bg-white p-6 rounded-lg shadow-sm border border-gray-200 transition duration-300">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ team.name }}</h3>
                            </div>
                            <button v-if="!team.has_relations" @click="deleteTeam(team)"
                                class="text-gray-400 hover:text-danger transition" title="Supprimer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { router, Head } from '@inertiajs/vue3';
import CreateTeam from '../../components/modal/CreateTeam.vue';
import { useToasterStore } from '../../store/Toast';
import EmptyView from '../../components/ui/EmptyView.vue';
import { useConfirmStore } from '../../store/confirmStore';
defineProps({
    teams: Array,
});
const confirm = useConfirmStore()

const deleteTeam = async (team) => {
    const isConfirmed = await confirm.show({
        title: 'Suppression',
        message: `Voulez-vous vraiment supprimer l'equipe ${team.name} ?`,
        confirmText: 'Oui, supprimer',
        cancelText: 'Non, annuler'
    })
    if (isConfirmed) {
        router.delete(`/edition/equipes/supprimer/${team.id}`, {
            preserveScroll: true,
            onSuccess: () => {
                useToasterStore().success({ text: 'Équipe supprimée avec succès' });
            },
            onError: (errors) => {
                console.log('Erreur lors de la suppression de l\'équipe:', errors);
            }
        });
    }
};

const showForm = ref(false);




</script>
