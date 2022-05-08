import { createStore } from 'vuex'

export default createStore({
  state: {
    sidebarVisible: '',
    sidebarUnfoldable: false,
    isLoggedIn : false,
    user : {}
  },
  mutations: {
    toggleSidebar(state) {
      state.sidebarVisible = !state.sidebarVisible
    },
    toggleUnfoldable(state) {
      state.sidebarUnfoldable = !state.sidebarUnfoldable
    },
    updateSidebarVisible(state, payload) {
      state.sidebarVisible = payload.value
    },
    setLogin(state) {
      state.isLoggedIn = true
    },
    setLogout(state){
      state.isLoggedIn = false
      state.user = {}
    },
    setUserData(state,payload) {
      state.user = payload
    }
  },
  actions: {},
  modules: {},
})
