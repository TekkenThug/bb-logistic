import { roles } from "../data/constants";

export default {
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
}