<template>
    <div class="mb-6">
      <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ label }} <span v-if="required" class="text-red-500">*</span>
      </label>
  
      <div
        @dragover.prevent="dragover = true"
        @dragleave.prevent="dragover = false"
        @drop.prevent="handleDrop"
        :class="[
          'mt-1 flex justify-center px-6 pt-5 pb-6 rounded-lg cursor-pointer',
          dragover ? 'border-2 border-primary bg-primary/10' : 'border-2 border-light border-dashed',
          error ? 'border-red-500' : ''
        ]"
      >
        <div class="space-y-1 text-center" v-if="!previewUrl">
          <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
            <path
              d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <div class="flex text-sm text-gray-600 justify-center">
            <label class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80">
              <span>Téléverser une image</span>
              <input
                type="file"
                class="sr-only"
                :accept="accept"
                @change="handleFileChange"
                ref="fileInput"
              />
            </label>
            <p class="pl-1">ou glisser-déposer</p>
          </div>
          <p class="text-xs text-gray-500">{{ fileRequirements }}</p>
          <p v-if="error" class="text-sm text-red-600">{{ error }}</p>
        </div>
  
        <div v-else class="relative w-full">
          <img :src="previewUrl" class="max-h-64 mx-auto rounded-lg" :alt="`Prévisualisation ${label}`" />
          <button
            type="button"
            @click="removeImage"
            class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, watch, onMounted } from 'vue'
  
  const props = defineProps({
    modelValue: File,
    label: {
      type: String,
      default: 'Image'
    },
    error: String,
    required: {
      type: Boolean,
      default: false
    },
    accept: {
      type: String,
      default: 'image/*'
    },
    fileRequirements: {
      type: String,
      default: 'PNG, JPG, JPEG jusqu\'à 5MB'
    },
    initialImage: {
      type: String,
      default: null
    }
  })
  
  const emit = defineEmits(['update:modelValue'])
  
  const fileInput = ref(null)
  const dragover = ref(false)
  const previewUrl = ref(null)
  
  onMounted(() => {
    if (props.initialImage && !previewUrl.value) {
      previewUrl.value = props.initialImage
    }
  })
  
  watch(() => props.initialImage, (newVal) => {
    if (newVal && !previewUrl.value) {
      previewUrl.value = newVal
    }
  })
  
  const handleFileChange = (e) => {
    const file = e.target.files[0]
    if (file && validateFile(file)) {
      emit('update:modelValue', file)
      createPreview(file)
    }
  }
  
  const handleDrop = (e) => {
    dragover.value = false
    const file = e.dataTransfer.files[0]
    if (file && validateFile(file)) {
      emit('update:modelValue', file)
      createPreview(file)
    }
  }
  
  const validateFile = (file) => {
    if (!file.type.match('image.*')) {
      alert('Veuillez sélectionner une image valide')
      return false
    }
    return true
  }
  
  const createPreview = (file) => {
    const reader = new FileReader()
    reader.onload = (e) => {
      previewUrl.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
  
  const removeImage = () => {
    previewUrl.value = null
    emit('update:modelValue', null)
    if (fileInput.value) {
      fileInput.value.value = ''
    }
  }
  </script>
  