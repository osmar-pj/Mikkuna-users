import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'

import Login from './auth/Login.vue'
import Register from './auth/Register.vue'
import Terms from './auth/Terms.vue'
import Home from './components/Home.vue'
import Dashboard from './components/Dashboard.vue'
import Inventario from './components/Inventario.vue'
import NewInventario from './components/NewInventario.vue'
import EditInventario from './components/EditInventario.vue'
import Pedidos from './components/Pedidos.vue'
import Empresa from './components/Empresa.vue'

import store from './store'
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            component: Register
        },
        {
            path: '/terms',
            component: Terms
        },
        {
            path: '/',
            component: Home,
            meta: {
                requireAuth: true
            },
            children: [
                {
                    path: '',
                    component: Dashboard
                },
                {
                    path: 'inventario',
                    component: Inventario
                },
                {
                    path: 'new_inventario',
                    component: NewInventario
                },
                {
                    path: 'edit_inventario',
                    component: EditInventario
                },
                {
                    path: 'pedidos',
                    component: Pedidos
                },
                {
                    path: 'empresa',
                    component: Empresa
                }
            ]
        }
    ]
})

router.beforeEach((to, from, next) => {
    const requireAuth = to.matched.some(record => record.meta.requireAuth)
    const currentUser = store.state.currentUser
    if(requireAuth && !currentUser) {
        next('/login')
    } else if (to.path == '/login' && currentUser) {
        next('/')
    } else {
        next()
    }
})

axios.interceptors.response.use(null, (error) => {
    if (error.response.status == 401) {
        store.commit('logout')
        router.push('/login')
    }

    return Promise.reject(error)
})

//axios.defaults.headers.common["Authorization"] = `Bearer ${store.getters.currentUser.token}`

export default router