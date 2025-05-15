// stores/confirm.ts
import { defineStore } from "pinia";
import { ref, watch } from "vue";

interface ConfirmPayload {
  title?: string;
  message: string;
  confirmText?: string;
  cancelText?: string;
  onConfirm?: () => void;
  onCancel?: () => void;
}

export const useConfirmStore = defineStore('confirm', () => {
  const isOpen = ref(false);
  const payload = ref<ConfirmPayload>({
    title: 'Confirmation',
    message: 'Êtes-vous sûr de vouloir effectuer cette action ?',
    confirmText: 'Confirmer',
    cancelText: 'Annuler'
  });

  const show = (newPayload: ConfirmPayload) => {
    payload.value = { ...payload.value, ...newPayload };
    isOpen.value = true;

    return new Promise<boolean>((resolve) => {
      const unwatch = watch(isOpen, (value) => {
        if (!value) {
          resolve(state.value === 'confirmed');
          unwatch();
        }
      });
    });
  };

  const state = ref<'idle' | 'confirmed' | 'cancelled'>('idle');

  const confirm = () => {
    state.value = 'confirmed';
    payload.value.onConfirm?.();
    isOpen.value = false;
  };

  const cancel = () => {
    state.value = 'cancelled';
    payload.value.onCancel?.();
    isOpen.value = false;
  };

  return {
    isOpen,
    payload,
    show,
    confirm,
    cancel
  };
});
