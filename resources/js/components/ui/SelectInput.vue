<template>
    <div class="mb-4 flex flex-col">
      <label v-if="label" :for="name" class="block text-sm font-medium text-gray-700 mb-1">
        {{ label }}<span v-if="required" class="text-red-600">*</span>
      </label>

      <div
        :class="[
          'flex items-center rounded-md shadow-sm border',
          errorMessage ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-primary focus:ring-primary',
          selectPosition === 'right' ? 'flex-row-reverse' : ''
        ]"
      >
        <!-- Select Part -->
        <select
          v-model="selectedOption"
          @change="updateCombinedValue"
          :class="[
            'border-none bg-transparent py-2 pl-3 pr-8 text-base focus:outline-none focus:ring-0 sm:text-sm',
            selectClass
          ]"
        >
          <option
            v-for="option in options"
            :key="option.value"
            :value="option.value"
            :disabled="option.disabled"
          >
            {{ option.label }}
          </option>
        </select>

        <!-- Separator -->
        <span v-if="separator" class="px-2 text-gray-500">{{ separator }}</span>

        <!-- Input Part -->
        <div class="relative flex-1">
          <MaterialIcon
            v-if="icon"
            :icon="icon"
            class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400"
          />
          <input
            :id="name"
            v-model="inputValue"
            :type="type"
            :placeholder="placeholder"
            :autocomplete="autocomplete"
            @input="updateCombinedValue"
            :class="[
              'block w-full rounded-md border-none py-2 pl-10 pr-3 text-gray-900 focus:ring-0 sm:text-sm',
              inputClass
            ]"
          />
        </div>
      </div>

      <p
        v-if="errorMessage || hint"
        :class="[
          'mt-1 text-sm',
          errorMessage ? 'text-red-600' : 'text-gray-500'
        ]"
      >
        {{ errorMessage || hint }}
      </p>
    </div>
  </template>

  <script setup lang="ts">
  import { useField } from 'vee-validate';
  import { ref, watch, computed } from 'vue';
  import MaterialIcon from './MaterialIcon.vue';

  interface Option {
    value: string;
    label: string;
    disabled?: boolean;
  }

  interface Props {
    name: string;
    type?: string;
    placeholder?: string;
    label?: string;
    icon?: string;
    hint?: string;
    required?: boolean;
    autocomplete?: string;
    options: Option[];
    separator?: string;
    selectPosition?: 'left' | 'right';
    selectClass?: string;
    inputClass?: string;
  }

  const props = withDefaults(defineProps<Props>(), {
    type: 'text',
    required: false,
    separator: '',
    selectPosition: 'left',
    selectClass: '',
    inputClass: ''
  });

  const emit = defineEmits(['update:modelValue']);

  const { value: fieldValue, errorMessage } = useField(() => props.name);

  const selectedOption = ref(props.options[0]?.value || '');
  const inputValue = ref('');

  const updateCombinedValue = () => {
    const combined = props.selectPosition === 'left'
      ? `${selectedOption.value}${props.separator}${inputValue.value}`
      : `${inputValue.value}${props.separator}${selectedOption.value}`;

    fieldValue.value = combined;
    emit('update:modelValue', combined);
  };

  const splitInitialValue = () => {
    if (!fieldValue.value) return;

    // Try to find a matching option
    const matchingOption = props.options.find(option => {
      if (props.selectPosition === 'left') {
        return fieldValue.value.startsWith(option.value + props.separator);
      } else {
        return fieldValue.value.endsWith(props.separator + option.value);
      }
    });

    if (matchingOption) {
      selectedOption.value = matchingOption.value;
      if (props.selectPosition === 'left') {
        inputValue.value = fieldValue.value.replace(matchingOption.value + props.separator, '');
      } else {
        inputValue.value = fieldValue.value.replace(props.separator + matchingOption.value, '');
      }
    }
  };

  // Initialize values
  watch(() => fieldValue.value, (newVal) => {
    if (newVal && !inputValue.value) {
      splitInitialValue();
    }
  }, { immediate: true });

  // React to options changes
  watch(() => props.options, (newOptions) => {
    if (newOptions.length > 0 && !newOptions.some(opt => opt.value === selectedOption.value)) {
      selectedOption.value = newOptions[0].value;
      updateCombinedValue();
    }
  });
  </script>
