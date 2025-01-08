import { defineStore } from "pinia";
import { ref } from "vue";

export const useAppStore = defineStore('app', () => {
    const theme = ref("dark");

    const toggleTheme = () => {
        theme.value = theme.value === "dark" ? "light" : "dark";
    }

    return {
        theme,
        toggleTheme,
    }
})
