import Cookie from 'cookie'
import Cookies from 'js-cookie'

export const state = () => ({
  sidebar: true,
  token: null,
  user: null
})

export const mutations = {
  // SET SIDEBAR
  toggleSidebar (state) {
    state.sidebar = !state.sidebar
  },
  // SET USER
  setUser (state, user) {
    state.user = user
  },
  // SET TOKEN
  setToken (state, token) {
    state.token = token
  }
}

export const getters = {
    isAuthenticated(state) {
      return state.auth.loggedIn
    },
    Token(state) {
      return state.token
    },
    loggedInUser(state) {
      return state.auth.user
    }
  }