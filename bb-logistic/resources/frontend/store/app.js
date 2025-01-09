import { defineStore } from "pinia";
import { KEYS } from "@/data/localstorage";

export const useAppStore = defineStore('app', {
    state: () => ({ theme: localStorage.getItem(KEYS.theme) ?? "light" }),

    actions: {
        toggleTheme() {
            const newTheme = this.theme === "dark" ? "light" : "dark";

            this.theme = newTheme
            localStorage.setItem(KEYS.theme, newTheme)
        }
    }
})
