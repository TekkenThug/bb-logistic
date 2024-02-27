import { createStore } from "vuex";
import { ROLES } from "@/data/constants";

export default createStore({
  state: {
    user: null
  },

  mutations: {
    setUser(state, { token, role }) {
      state.user = { token, role };
    }
  },

  getters: {
    role: (state) => state.user && state.user.role ? ROLES[state.user.role] : null,
  }
})