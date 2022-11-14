import { createStore } from 'vuex'

const store = createStore({

  state: {
    token : localStorage.getItem('token') || 0,
    user_role : localStorage.getItem('URID') || 0,
  },

  mutations: {
    UPDATE_TOKEN (state, payload) {
      state.token = payload;
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + payload;
    },
    UPDATE_USER_ROLE(state, payload){
      state.user_role = payload
    }
  },

  actions:{
     setToken(context, payload){
      localStorage.setItem('token', payload)
      context.commit('UPDATE_TOKEN', payload)
     },
     removeToken(context){
      localStorage.removeItem('token');
      localStorage.removeItem('URID');
      context.commit('UPDATE_TOKEN', 0)
      context.commit('UPDATE_USER_ROLE', '')
      delete axios.defaults.headers.Authorization;
     },

     setUserRole(context, payload){
      localStorage.setItem('URID', payload)
      context.commit('UPDATE_USER_ROLE', payload)
     }
  },

  getters: {
    getToken (state) {
      return state.token
    },
    getUrid(state){
      return state.user_role
    }
  }
})

export default store;