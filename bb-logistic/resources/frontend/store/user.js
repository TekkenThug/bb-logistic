import { defineStore } from "pinia";
import {computed, ref} from "vue";

export const useUserStore = defineStore('user', () => {
    const user = ref(null);

    const role = computed(() => user.value?.role);

    return {
        user,
        role
    }
})
