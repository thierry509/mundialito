import { ref } from "vue";
import { defineStore } from "pinia";

export type TToastStatus = "success" | "warning" | "error";

interface IToast {
  text: string;
  status: TToastStatus;
  id: number;
}

type ToastPayload = { timeout?: number; text: string };

const defaultTimeout = 5000;

const createToast = (text: string, status: TToastStatus): IToast => ({
  text,
  status,
  id: Math.random() * 1000,
});

export const useToasterStore = defineStore("toaster-store", () => {
  const toasts = ref<IToast[]>([]);

  const updateState = (payload: ToastPayload, status: TToastStatus) => {
    const { text, timeout } = payload;
    const toast = createToast(text, status);
    toasts.value.push(toast);

    setTimeout(() => {
      toasts.value = toasts.value.filter((t) => t.id !== toast.id);
    }, timeout ?? defaultTimeout);
  };

  const success = (payload: ToastPayload) => updateState(payload, "success");
  const warning = (payload: ToastPayload) => updateState(payload, "warning");
  const error = (payload: ToastPayload) => updateState(payload, "error");

  return { toasts, success, warning, error };
});
