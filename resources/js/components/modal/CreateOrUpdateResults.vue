<script setup>
import { ref, computed, onUnmounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import BaseModal from './BaseModal.vue';
import { useToasterStore } from '@/store/Toast';

const props = defineProps({
    show: Boolean,
    game: Object
});

const emit = defineEmits(['close']);


// Données réactives
const teamAGoals = ref(props.game.team_a_goals || 0);
const teamBGoals = ref(props.game.team_b_goals || 0);
const teamAYellowCards = ref(props.game.team_a_yellow_cards || 0);
const teamBYellowCards = ref(props.game.team_b_yellow_cards || 0);
const teamARedCards = ref(props.game.team_a_red_cards || 0);
const teamBRedCards = ref(props.game.team_b_red_cards || 0);
const shootoutScoreA = ref(props.game.shootout_score_a || null);
const shootoutScoreB = ref(props.game.shootout_score_b || null);
const teamAScorers = ref(props.game.team_a_scorers ? props.game.team_a_scorers.split(',') : []);
const teamBScorers = ref(props.game.team_b_scorers ? props.game.team_b_scorers.split(',') : []);
const isLive = ref(props.game.status == 'live' ? true : false);
const shootoutScore = ref(props.game.shootout_score_a ? true : false);


const refMap = {
    teamAGoals,
    teamBGoals,
    teamAYellowCards,
    teamBYellowCards,
    teamARedCards,
    teamBRedCards,
    teamAScorers,
    teamBScorers,
    shootoutScoreA,
    shootoutScoreB,
}
// Initialisation du formulaire Inertia
const form = useForm({
    gameId: props.game.id,
    teamAGoals: teamAGoals.value,
    teamBGoals: teamBGoals.value,
    teamAYellowCards: teamAYellowCards.value,
    teamBYellowCards: teamBYellowCards.value,
    teamARedCards: teamARedCards.value,
    teamBRedCards: teamBRedCards.value,
    isLive: isLive,
    shootoutScoreA: shootoutScoreA.value,
    shootoutScoreB: shootoutScoreB.value,
    extraTime: false,
    shootoutScore: shootoutScore.value,
});

const processing = ref(false);

// Méthodes pour gérer les incréments/décréments
const increment = (refName) => {
    const valueRef = refMap[refName]
    if (valueRef) {
        valueRef.value++
        console.log(`${refName} → ${valueRef.value}`)
        updateForm()
    } else {
        console.warn(`Ref "${refName}" not found`)
    }
}

const decrement = (refName) => {
    const valueRef = refMap[refName]
    if (valueRef) {
        if (valueRef.value > 0) valueRef.value--;
        updateForm();
    } else {
        console.warn(`Ref "${refName}" not found`)
    }
};


// Mise à jour du formulaire
const updateForm = () => {
    form.teamAGoals = teamAGoals.value;
    form.teamBGoals = teamBGoals.value;
    form.teamAYellowCards = teamAYellowCards.value;
    form.teamBYellowCards = teamBYellowCards.value;
    form.teamARedCards = teamARedCards.value;
    form.teamBRedCards = teamBRedCards.value;
    form.shootoutScoreA = shootoutScoreA;
    form.shootoutScoreB = shootoutScoreB;
    shootoutScoreToggle();
};

const shootoutScoreToggle = () => {
    if (form.shootoutScore) {
        shootoutScoreA.value = shootoutScoreA.value || 0;
        shootoutScoreB.value = shootoutScoreB.value || 0;
        form.shootoutScoreA = shootoutScoreA.value;
        form.shootoutScoreB = shootoutScoreB.value;
    } else {
        form.shootoutScoreA = null;
        form.shootoutScoreB = null;
    }
};

const submit = () => {
    form.put(`/edition/championnat/match`, {
        preserveScroll: true,
        onStart: () => {
            processing.value = true;
        },
        onFinish: () => {
            processing.value = false;
        },
        onSuccess: () => {
            useToasterStore().success({ text: 'Match mis à jour avec succès' });
            emit('close');
        },
        onError: (errors) => {
            console.log('Erreurs de validation:', errors);
        }
    });
};

const close = () => {
    form.reset();
    emit('close');
};
</script>

<template>
    <BaseModal :show="show" @close="close">
        <form @submit.prevent="submit" class="space-y-4">
            <div class="overflow-hidden">
                <div class="py-4">
                    <!-- En-tête du match -->
                    <div class="bg-gradient-to-r from-primary to-blue-600 p-4 text-white mb-4 rounded-t-lg">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-bold">{{ game.championship.year }}</h2>
                            <span class="bg-white/20 px-3 py-1 rounded-full text-xs">{{ game.stage }}</span>
                        </div>
                        <div class="flex justify-center items-center mt-3 space-x-6">
                            <div class="text-center">
                                <div class="text-lg font-bold truncate max-w-[100px]">{{ game.team_a.name }}</div>
                            </div>
                            <div class="text-2xl font-bold">VS</div>
                            <div class="text-center">
                                <div class="text-lg font-bold truncate max-w-[100px]">{{ game.team_b.name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 items-center gap-4 py-3 border-b border-gray-100">
                        <div class="font-medium text-gray-700"> </div>
                        <div class="flex items-center justify-center space-x-2 text-bold">
                            {{ game.team_a.name }}
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            {{ game.team_b.name }}
                        </div>
                    </div>

                    <!-- Ligne Buts -->
                    <div class="grid grid-cols-3 items-center gap-4 py-3 border-b border-gray-100">
                        <div class="font-medium text-gray-700">Buts</div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" @click="decrement('teamAGoals')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                -
                            </button>
                            <span class="text-xl font-bold w-8 text-center">{{ teamAGoals }}</span>
                            <button type="button" @click="increment('teamAGoals')"
                                class="w-8 h-8 flex items-center justify-center bg-secondary text-white rounded-full hover:bg-green-700 transition">
                                +
                            </button>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" @click="decrement('teamBGoals')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                -
                            </button>
                            <span class="text-xl font-bold w-8 text-center">{{ teamBGoals }}</span>
                            <button type="button" @click="increment('teamBGoals')"
                                class="w-8 h-8 flex items-center justify-center bg-secondary text-white rounded-full hover:bg-green-700 transition">
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Ligne Cartons Jaunes -->
                    <div class="grid grid-cols-3 items-center gap-4 py-3 border-b border-gray-100">
                        <div class="font-medium text-gray-700">Cartons Jaunes</div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" @click="decrement('teamAYellowCards')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                -
                            </button>
                            <span class="text-xl font-bold w-8 text-center">{{ teamAYellowCards }}</span>
                            <button type="button" @click="increment('teamAYellowCards')"
                                class="w-8 h-8 flex items-center justify-center bg-danger text-white rounded-full hover:bg-yellow-700 transition">
                                +
                            </button>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" @click="decrement('teamBYellowCards')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                -
                            </button>
                            <span class="text-xl font-bold w-8 text-center">{{ teamBYellowCards }}</span>
                            <button type="button" @click="increment('teamBYellowCards')"
                                class="w-8 h-8 flex items-center justify-center bg-danger text-white rounded-full hover:bg-yellow-700 transition">
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Ligne Cartons Rouges -->
                    <div class="grid grid-cols-3 items-center gap-4 py-3 border-b border-gray-100">
                        <div class="font-medium text-gray-700">Cartons Rouges</div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" @click="decrement('teamARedCards')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                -
                            </button>
                            <span class="text-xl font-bold w-8 text-center">{{ teamARedCards }}</span>
                            <button type="button" @click="increment('teamARedCards')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                +
                            </button>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" @click="decrement('teamBRedCards')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                -
                            </button>
                            <span class="text-xl font-bold w-8 text-center">{{ teamBRedCards }}</span>
                            <button type="button" @click="increment('teamBRedCards')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                +
                            </button>
                        </div>
                    </div>
                    <div v-if="game.type == 'knockout' && teamAGoals === teamBGoals"
                        class="grid grid-cols-3 items-center gap-4 py-3 border-b border-gray-100">
                        <div class="font-medium text-gray-700">Tire au but</div>

                        <!-- Option: Oui -->
                        <div class="flex items-center justify-center space-x-2">
                            <input type="radio" id="enDirectOui" @change="shootoutScoreToggle" :value="true"
                                v-model="form.shootoutScore" class="accent-green-600" />
                            <label for="enDirectOui" class="text-gray-600">Oui</label>
                        </div>

                        <!-- Option: Non -->
                        <div class="flex items-center justify-center space-x-2">
                            <input type="radio" id="enDirectNon" @change="shootoutScoreToggle" :value="false"
                                v-model="form.shootoutScore" class="accent-red-600" />
                            <label for="enDirectNon" class="text-gray-600">Non</label>
                        </div>
                    </div>
                    <div v-if="form.shootoutScore"
                        class="grid grid-cols-3 items-center gap-4 py-3 border-b border-gray-100">
                        <div class="font-medium text-gray-700">Score tire au but</div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" @click="decrement('shootoutScoreA')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                -
                            </button>
                            <span class="text-xl font-bold w-8 text-center">{{ shootoutScoreA }}</span>
                            <button type="button" @click="increment('shootoutScoreA')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                +
                            </button>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <button type="button" @click="decrement('shootoutScoreB')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                -
                            </button>
                            <span class="text-xl font-bold w-8 text-center">{{ shootoutScoreB }}</span>
                            <button type="button" @click="increment('shootoutScoreB')"
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-full hover:bg-red-700 transition">
                                +
                            </button>
                        </div>
                    </div>
                    <!-- Ligne en direct ou non -->
                    <div class="grid grid-cols-3 items-center gap-4 py-3 border-b border-gray-100">
                        <div class="font-medium text-gray-700">En-direct</div>

                        <!-- Option: Oui -->
                        <div class="flex items-center justify-center space-x-2">
                            <input type="radio" id="enDirectOui" :value="true" v-model="form.isLive"
                                class="accent-green-600" />
                            <label for="enDirectOui" class="text-gray-600">Oui</label>
                        </div>

                        <!-- Option: Non -->
                        <div class="flex items-center justify-center space-x-2">
                            <input type="radio" id="enDirectNon" :value="false" v-model="form.isLive"
                                class="accent-red-600" />
                            <label for="enDirectNon" class="text-gray-600">Non</label>
                        </div>
                    </div>

                </div>
                <!-- Actions -->
                <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t">
                    <button type="button" @click="close"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 text-sm hover:bg-gray-100 transition">
                        Annuler
                    </button>
                    <button type="submit" :disabled="processing"
                        class="px-4 py-2 bg-primary text-white rounded-lg text-sm hover:bg-blue-700 transition disabled:opacity-50">
                        <span v-if="processing">Enregistrement...</span>
                        <span v-else>Enregistrer</span>
                    </button>
                </div>
            </div>
        </form>
    </BaseModal>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
