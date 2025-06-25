<template>
    <div class="mb-6">
      <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700 mb-1">
        {{ label }} <span v-if="required" class="text-red-500">*</span>
      </label>

      <select
        :id="name"
        :name="name"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur')"
        :class="[
          'outline-none w-full rounded-lg border focus:ring-2 p-3 appearance-none bg-white',
          error ? 'border-red-500 focus:border-red-500 focus:ring-red-500/50'
                : 'border-light focus:border-primary focus:ring-primary/50'
        ]"
      >
        <option v-if="placeholder" value="" disabled selected hidden>
          {{ placeholder }}
        </option>
        <option
          v-for="option in options"
          :key="option.value"
          :value="option.value"
          :disabled="option.disabled"
        >
          {{ option.label }}
        </option>
      </select>

      <p v-if="error" class="mt-1 text-sm text-red-600">
        {{ error }}
      </p>
      <p v-else-if="helperText" class="mt-1 text-sm text-gray-500">
        {{ helperText }}
      </p>
    </div>
  </template>

  <script setup>
  defineProps({
    modelValue: [String, Number, Boolean],
    name: String,
    label: String,
    placeholder: String,
    helperText: String,
    error: String,
    required: {
      type: Boolean,
      default: false
    },
    options: {
      type: Array,
      required: true,
      validator: (options) => {
        return options.every(option => 'value' in option && 'label' in option)
      }
    }
  })

  defineEmits(['update:modelValue', 'blur'])
  </script>
