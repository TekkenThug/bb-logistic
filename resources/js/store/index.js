import Vue from "vue";
import Vuex from "vuex";
import { roles } from "../data/constants";

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
    userRole: (state) => state.user && state.user.role ? roles[state.user.role] : null
  }
})