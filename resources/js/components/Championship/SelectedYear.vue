<template>
    <div class="ml-2 relative">
      <select
        v-model="selectedYear"
        @change="saveYearToStorage"
        class="bg-white text-gray-900 rounded-lg px-3 py-1 pr-6 text-sm border border-gray-200 hover:border-gray-300 focus:outline-none focus:ring-1 focus:ring-primary/50 focus:border-primary appearance-none cursor-pointer transition-all"
      >
        <option v-for="year in availableYears" :key="year" :value="year">
          {{ year }}
        </option>
      </select>
      <!-- Icône de flèche moderne -->
      <div class="pointer-events-none absolute inset-y-0 right-1 flex items-center">
        <svg
          class="h-3.5 w-3.5 text-gray-400"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19 9l-7 7-7-7"
          ></path>
        </svg>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, onMounted, computed, watch } from 'vue'
  import { usePage } from '@inertiajs/vue3'
  import { router } from '@inertiajs/vue3'
import { useYearStore } from '../../store/year'
  // Configuration des années disponibles
  const availableYears = computed(() => usePage().props.years)
  const selectedYear = ref(null)
  const yearStore = useYearStore()



  onMounted(() =>{
    if(!yearStore.year){
      yearStore.setYear(availableYears.value[0])
    }
    selectedYear.value = yearStore.year
    watch(selectedYear, (newYear) => {
      yearStore.setYear(newYear)
      router.reload({
        data: {
            year: newYear,
        },
        preserveScroll: true,
    })
    })
  })
  </script>
