<template>
    <TransitionRoot appear :show="hasErrors" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-50">
        <!-- Overlay -->
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" />
        </TransitionChild>

        <!-- Modal -->
        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle
                  as="h3"
                  class="flex items-center text-lg font-medium leading-6 text-red-800"
                >
                  <svg
                    class="h-6 w-6 mr-2 text-red-500"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  Erreurs de validation
                </DialogTitle>

                <div class="mt-4">
                  <p class="text-sm text-gray-500 mb-3">
                    Veuillez corriger les {{ errorCount }} erreur(s) dans le formulaire :
                  </p>

                  <ul class="max-h-60 overflow-y-auto text-sm text-red-700 space-y-2">
                    <li
                      v-for="(error, field) in errors"
                      :key="field"
                      class="flex items-start"
                    >
                      <svg
                        class="h-4 w-4 mt-0.5 mr-1.5 text-red-500 flex-shrink-0"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      <span>{{ error }}</span>
                    </li>
                  </ul>
                </div>

                <div class="mt-6">
                  <button
                    type="button"
                    @click="closeModal"
                    class="inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2"
                  >
                    J'ai compris
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>

  <script setup>
  import { computed, ref, watch } from 'vue'
  import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
  } from '@headlessui/vue'

  const props = defineProps({
    errors: {
      type: Object,
      default: () => ({})
    }
  })

  const emit = defineEmits(['close'])

  const isOpen = ref(false)

  // Ouvrir automatiquement quand il y a des erreurs
  watch(() => props.errors, (newErrors) => {
    if (Object.keys(newErrors).length > 0) {
      isOpen.value = true
    }
  }, { immediate: true, deep: true })

  const hasErrors = computed(() => {
    return isOpen.value && Object.keys(props.errors).length > 0
  })

  const errorCount = computed(() => {
    return Object.keys(props.errors).length
  })

  const closeModal = () => {
    isOpen.value = false
    emit('close')
  }
  </script>
