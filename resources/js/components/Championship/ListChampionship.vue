<template>
    <!-- Championships List -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-lg text-gray-900">Edition disponible</h3>
        </div>
        <div v-if="$page.props.years.length > 0" class="">
            <div v-for="year in $page.props.years" class="space-y-4" :key="year.id">
                <div class="group block cursor-pointer">
                    <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                        <div
                            class="flex-shrink-0 h-12 w-12 rounded-lg bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900 group-hover:text-blue-600">Mundialito {{ year }}
                                </h4>
                            </div>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="flex items-center justify-center min-h-[200px] rounded-lg bg-gray-50/50">
            <div class="text-center p-6 max-w-xs mx-auto">
                <!-- Icône animée -->
                <div class="animate-bounce-slow mb-4">
                    <svg class="h-14 w-14 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <!-- Texte -->
                <h3 class="text-lg font-medium text-gray-600 mb-1">Aucune édition disponible</h3>

                <!-- Bouton optionnel -->
                <button v-if="showRefreshButton" @click="refreshData" class="mt-4 px-4 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-500 
                   hover:bg-indigo-50 rounded-md transition-all">
                    Actualiser
                </button>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button
                class="border border-primary text-primary text-xs  py-2 px-4 rounded-lg transition font-medium flex items-center justify-center gap-2 hover:scale-105 transform"
                @click="openCreateChampionshipModal">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter une nouvelle édition
            </button>
        </div>
    </div>

    <CreateChampionship :show="showModal" @close="closeCreateChampionshipModal" />

</template>

<script setup>
import CreateChampionship from '../modal/CreateChampionship.vue';
import { ref } from 'vue';
const showModal = ref(false);
const openCreateChampionshipModal = () => {
    showModal.value = true;
};

const closeCreateChampionshipModal = () => {
    showModal.value = false;
};
</script>
