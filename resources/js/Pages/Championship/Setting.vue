<template>
    <div class="bg-white shadow-2xl rounded-3xl p-8 w-full max-w-3xl mx-auto">
      <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Paramètres de la Compétition</h1>
  
      <!-- Règles de classement -->
      <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">1. Ordre des Règles de Classement</h2>
        <ul ref="rulesList" class="space-y-3">
          <li
            v-for="(rule, index) in rules"
            :key="rule.rule"
            :data-rule="rule.rule"
            class="bg-white border border-blue-100 p-4 rounded-xl cursor-move flex items-center justify-between shadow-sm hover:shadow-md transition-all group"
          >
            <div class="flex items-center gap-3">
              <span class="text-sm text-gray-500 font-medium w-6">{{ index + 1 }}</span>
              <span class="text-gray-800 font-semibold">{{ rule.label }}</span>
            </div>
            <div class="text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
              <i data-lucide="chevron-up" class="w-4 h-4"></i>
              <i data-lucide="chevron-down" class="w-4 h-4"></i>
            </div>
          </li>
        </ul>
      </div>
  
      <!-- Round de démarrage phase finale -->
      <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">2. Phase Finale - Commence à partir de</h2>
        <select v-model="finalPhase" class="w-full border border-blue-300 rounded-xl p-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="none">Aucune phase finale</option>
          <option value="quarter">Quart de finale</option>
          <option value="semi">Demi-finale</option>
          <option value="final">Finale</option>
        </select>
      </div>
  
      <button @click="saveParams" class="w-full bg-blue-600 text-white py-3 rounded-xl text-lg font-semibold shadow hover:bg-blue-700 transition-all">
        Sauvegarder les paramètres
      </button>
  
      <pre v-if="outputVisible" class="mt-6 bg-gray-100 p-4 rounded-xl text-sm">{{ output }}</pre>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import Sortable from 'sortablejs';
//   import { createIcons } from 'lucide';
  
  const rulesList = ref(null);
  
  const rules = ref([
    { rule: 'points', label: 'Points' },
    { rule: 'diff_buts', label: 'Différence de buts' },
    { rule: 'buts_marques', label: 'Buts marqués' },
    { rule: 'confrontation_directe_points', label: 'Points en confrontation directe' },
    { rule: 'victoires', label: 'Nombre de victoires' },
    { rule: 'fair_play', label: 'Classement fair-play' },
    { rule: 'match_appui', label: 'Match d\'appui' },
    { rule: 'tirage_au_sort', label: 'Tirage au sort' },
  ]);
  
  const finalPhase = ref('none');
  const output = ref('');
  const outputVisible = ref(false);
  
  onMounted(() => {
    // createIcons();
  
    Sortable.create(rulesList.value, {
      animation: 150,
      ghostClass: 'bg-yellow-100',
      onEnd: (evt) => {
        const newOrder = Array.from(rulesList.value.children).map((el) => el.getAttribute('data-rule'));
        rules.value = newOrder.map((ruleKey) => rules.value.find((r) => r.rule === ruleKey));
      },
    });
  });
  
  function saveParams() {
    output.value = JSON.stringify({
      rules_order: rules.value.map((r) => r.rule),
      final_phase: finalPhase.value,
    }, null, 2);
    outputVisible.value = true;
  }
  </script>
  
  <style scoped>
  </style>
  