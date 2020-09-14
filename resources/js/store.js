import Vue from 'vue'
import Vuex from 'vuex'
import { getLocalUser } from './help/auth'
import { getInventarios, getCustomers, getPedidos, getStats } from './help/crud'

Vue.use(Vuex)

const user = getLocalUser()

const store = new Vuex.Store({
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        inventarios: [],
        customers: [],
        pedidos: [],
        stats: []
    },
    getters: {
        isLoading(state) {
            return state.loading
        },
        isLoggedIn(state) {
            return state.isLoggedIn
        },
        currentUser(state) {
            return state.currentUser
        },
        authError(state) {
            return state.auth_error
        },
        inventarios(state) {
            return state.inventarios
        },
        customers(state) {
            return state.customers
        },
        pedidos(state) {
            return state.pedidos
        },
        stats(state) {
            return state.stats
        }
    },
    mutations: {
        login(state) {
            state.loading = true
            state.auth_error = null
        },
        loginSuccess(state, payload) {
            state.auth_error = null
            state.isLoggedIn = true
            state.loading = false
            state.currentUser = Object.assign({}, payload.user, { token: payload.access_token })
            localStorage.setItem('user', JSON.stringify(state.currentUser))
        },
        registerSuccess(state, payload) {
            state.auth_error = null
            state.isLoggedIn = true
            state.loading = false
            state.currentUser = Object.assign({}, payload.user, { token: payload.access_token })
            localStorage.setItem('user', JSON.stringify(state.currentUser))
        },
        loginFailed(state, payload) {
            state.loading = false
            state.auth_error = payload.err
        },
        logout(state) {
            localStorage.removeItem('user')
            state.isLoggedIn = false
            state.currentUser = null
        },
        inventarios(state, payload) {
            state.inventarios = payload
        },
        customers(state, payload) {
            state.customers = payload
        },
        pedidos(state, payload) {
            state.pedidos = payload
        },
        stats(state, payload) {
            state.stats = payload
        },
    },
    actions: {
        login(context) {
            context.commit('login')
        },
        getInventarios(context) {
            getInventarios()
            .then(res => {
                context.commit('inventarios', res)
            })
        },
        getCustomers(context) {
            getCustomers()
            .then(res => {
                context.commit('customers', res)
            })
        },
        getPedidos(context) {
            getPedidos()
            .then(res => {
                context.commit('pedidos', res)
            })
        },
        getStats(context) {
            getStats()
            .then(res => {
                context.commit('stats', res)
            })
        }
    }
})

export default store