<template>
    <div class="relative">
      <!-- Input field -->
      <input
        v-model="searchQuery"
        @focus="focusInput"
        @blur="handleBlur"
        @keydown.arrow-down="highlightNext"
        @keydown.arrow-up="highlightPrev"
        @keydown.enter="selectHighlighted"
        :class="[
          'outline-none w-full rounded-lg border focus:ring-2 p-3',
          error ? 'border-red-500 focus:border-red-500 focus:ring-red-500/50'
                : 'border-light focus:border-primary focus:ring-primary/50'
        ]"
        :placeholder="placeholder"
      />
      <div class="pointer-events-none absolute inset-y-0 right-1 flex items-center text-primary">
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

      <p v-if="error" class="mt-1 text-sm text-red-600">
        {{ error }}
      </p>

      <!-- Dropdown menu -->
      <div
        v-show="showDropdown && filteredOptions.length > 0"
        class="absolute z-10 mt-1 w-full min-w-[280px] bg-white rounded-lg shadow-lg border border-gray-200 max-h-60 overflow-auto"
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
    },
    placeholder: String,
    error: String,
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

  function focusInput(event) {
    showDropdown.value = true
    event.target.select()
  }
  </script>
