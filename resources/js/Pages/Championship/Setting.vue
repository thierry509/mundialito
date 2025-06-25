<template>
    <Head>
        <title>Paramètres de l'edition {{ championship?.year }}</title>
    </Head>
    <div class="p-6 md:p-8">
        <!-- Section Titre -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Paramètres de l'edition {{ championship?.year }}</h1>
            <p class="text-gray-600 mt-2">Configurez les règles de classement et les phases finales</p>
        </div>

        <!-- Section Règles disponibles -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Règles disponibles</h2>
            <p class="text-gray-600 mb-4">Sélectionnez les règles à appliquer :</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div v-for="rule in allRankingRules" :key="rule.code" class="flex items-center">
                    <input
                        type="checkbox"
                        :id="`rule-${rule.code}`"
                        v-model="selectedRules"
                        :value="rule.code"
                        class="h-4 w-4 text-primary rounded border-gray-300 focus:ring-primary"
                    >
                    <label :for="`rule-${rule.code}`" class="ml-3 text-sm font-medium text-gray-700">
                        {{ rule.label }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Section Règles de classement -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Ordre des règles</h2>
            <p class="text-gray-600 mb-4">Définissez l'ordre d'application des critères de classement :</p>

            <div class="space-y-3">
                <div
                    v-for="(ruleCode, index) in activeRules"
                    :key="ruleCode"
                    draggable="true"
                    @dragstart="dragStart(index)"
                    @dragover.prevent="dragOver(index)"
                    @drop="drop(index)"
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg cursor-move hover:bg-gray-100 transition"
                >
                    <div class="flex items-center">
                        <span class="text-gray-500 mr-3 text-sm font-medium">{{ index + 1 }}.</span>
                        <span class="font-medium text-gray-700">{{ getRuleLabel(ruleCode) }}</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Phase finale -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Phase finale</h2>

            <div class="grid grid-cols-1">
                <Select v-model="finalRoundStart" :options="[{ value: '4', label: '8èmes de finale' }, { value: '3', label: 'Quarts de finale' }, { value: '2', label: 'Demi-finales' }, { value: '1', label: 'Finale' }]" required
                :label="'Phase finale à partir de'" :placeholder="'Sélectionnez une phase finale'" class="w-full"
                />
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="flex justify-end space-x-4">
            <button
                @click="resetSettings"
                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition"
            >
                Réinitialiser
            </button>
            <button
                @click="saveSettings"
                class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition"
            >
                Enregistrer les paramètres
            </button>
        </div>
    </div>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';
import {useToasterStore} from '../../store/Toast'
import Select from '../../components/ui/Select.vue'
const props = defineProps({
    championship: Object,
    allRankingRules: Array
});

// Initialisation des règles sélectionnées
const initialSelectedRules = props.championship.ranking_rules?.map(r => r.code) || [];
const selectedRules = ref(initialSelectedRules);
const activeRules = ref([...initialSelectedRules]);

// Phase finale - conversion de la valeur numérique
const finalRoundStart = ref(props.championship.knockout_round?.toString() || '4 ');

// Mise à jour des règles actives
watch(selectedRules, (newVal) => {
    const newActiveRules = activeRules.value.filter(rule => newVal.includes(rule));
    newVal.forEach(rule => {
        if (!newActiveRules.includes(rule)) {
            newActiveRules.push(rule);
        }
    });
    activeRules.value = newActiveRules;
}, { deep: true });

// Libellés des règles
const getRuleLabel = (code) => {
    const rule = props.allRankingRules.find(r => r.code === code);
    return rule ? rule.label : code;
};

// Drag & drop
let draggedItemIndex = null;

const dragStart = (index) => {
    draggedItemIndex = index;
};

const dragOver = (index) => {
    if (draggedItemIndex !== null && draggedItemIndex !== index) {
        const newItems = [...activeRules.value];
        const [removed] = newItems.splice(draggedItemIndex, 1);
        newItems.splice(index, 0, removed);
        activeRules.value = newItems;
        draggedItemIndex = index;
    }
};

const drop = () => {
    draggedItemIndex = null;
};


// Sauvegarde
const saveSettings = () => {
    const formData = {
        ranking_rules: activeRules.value.map((code, index) => ({
            code,
            position: index + 1
        })),
        knockout_round: parseInt(finalRoundStart.value)
    };

    console.log('Données à envoyer:', formData);
    router.put('', formData, {
        preserveScroll: true,
        onSuccess: () => {
            useToasterStore().success({ text: 'Parametre modifier avec succès' });
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors)
        }
    });
};

// Réinitialisation
const resetSettings = () => {
    selectedRules.value = props.allRankingRules.map(rule => rule.code);
    finalRoundStart.value = '4';
};
</script>

<style scoped>
[draggable="true"] {
    transition: transform 0.2s ease;
}

[draggable="true"]:active {
    opacity: 0.7;
}
</style>
