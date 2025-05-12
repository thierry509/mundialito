<template>
    <div class="">
      <!-- Input field -->
      <input
        v-model="searchQuery"
        @focus="showDropdown = true"
        @blur="handleBlur"
        @keydown.arrow-down="highlightNext"
        @keydown.arrow-up="highlightPrev"
        @keydown.enter="selectHighlighted"
        class="team-input bg-transparent border-0 focus:ring-0 focus:border-primary focus:bg-white focus:rounded px-2 py-1 w-full max-w-[180px]"
        placeholder="Search..."
      />
      
      <!-- Dropdown menu -->
      <div 
        v-show="showDropdown && filteredOptions.length > 0"
        class="absolute z-10 mt-1 w-full max-w-[180px] bg-white rounded shadow-lg border border-gray-200 max-h-60 overflow-auto"
      >
        <ul>
          <li
            v-for="(option, index) in filteredOptions"
            :key="option.value"
            @mousedown="selectOption(option)"
            :class="{
              'bg-blue-100': highlightedIndex === index,
              'hover:bg-gray-100 cursor-pointer': true
            }"
            class="px-3 py-2 text-sm"
          >
            {{ option.label }}
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { options } from 'marked'
import { ref, computed, watch } from 'vue'
  
  const props = defineProps({
    options: {
      type: Array,
      default: () => [],
      validator: (options) => options.every(opt => opt.value && opt.label)
    },
    modelValue: {
      type: [String, Number, Object],
      default: null
    }
  })
  
  const emit = defineEmits(['update:modelValue'])
  
  const searchQuery = ref('')
  const showDropdown = ref(false)
  const highlightedIndex = ref(-1)
  
  const filteredOptions = computed(() => {
    if (!searchQuery.value) return props.options
    return props.options.filter(option => 
      option.label.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
  })
  
  function selectOption(option) {
    searchQuery.value = option.label
    emit('update:modelValue', option.value)
    showDropdown.value = false
  }
  
  function handleBlur() {
    setTimeout(() => {
      showDropdown.value = false
    }, 200)
  }
  
  function highlightNext() {
    if (highlightedIndex.value < filteredOptions.value.length - 1) {
      highlightedIndex.value++
    }
  }
  
  function highlightPrev() {
    if (highlightedIndex.value > 0) {
      highlightedIndex.value--
    }
  }
  
  function selectHighlighted() {
    if (highlightedIndex.value >= 0 && highlightedIndex.value < filteredOptions.value.length) {
      selectOption(filteredOptions.value[highlightedIndex.value])
    }
  }
  
  watch(searchQuery, () => {
    highlightedIndex.value = -1
  })
  </script>