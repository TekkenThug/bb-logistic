import Vue from "vue";
import Vuex from "vuex";
import { ROLES } from "@/data/constants";

Vue.use(Vuex);

export default new Vuex.Store({
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