import { defineStore } from 'pinia';
import { ref } from 'vue';
export const useYearStore = defineStore('year-store', () => {
    const year = ref(null);
    const setYear = (newYear) => {
        console.log('Setting year to:', newYear);
        year.value = newYear;
    }
    return { year, setYear };
}, {
    persist: {
        storage: sessionStorage
    }
});