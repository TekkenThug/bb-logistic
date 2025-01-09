import { defineStore } from "pinia";
import { ROLES } from "@/data/constants";

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null
    }),

    getters: {
        role: (state) => state.user?.role
    },

    actions: {
        setupUser(credentials) {
            this.user = { ...credentials, role: ROLES[credentials.role_id] };
        }
    }
})
