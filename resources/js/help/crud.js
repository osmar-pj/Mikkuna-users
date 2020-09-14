import axios from 'axios'
import store from '../store'

// POST

export function newInventario(data) {
    return new Promise((res, rej) => {
        axios.post('/api/new_inventario', data, {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.registered)
        })
        .catch(err => {
            rej('Falta completar algun dato', err)
        })
    })
}

export function editInventario(data) {
    return new Promise((res, rej) => {
        axios.post('/api/edit_inventario', data, {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.updated)
        })
        .catch(err => {
            rej('Falta completar algun dato', err)
        })
    })
}

export function registerPedido(data) {
    return new Promise((res, rej) => {
        axios.post('/api/register_pedido', data, {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.registered)
        })
        .catch(err => {
            rej('Falta completar algun dato', err)
        })
    })
}

export function postUpdateEmpresa(data) {
    return new Promise((res, rej) => {
        axios.post('/api/update_empresa', data, {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.updated)
        })
        .catch(err => {
            rej('Falta completar algun dato', err)
        })
    })
}

// GET

export function getInventarios() {
    return new Promise((res, rej) => {
        axios.get('/api/get_inventarios', {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.inventarios)
        })
        .catch(err => {
            rej('No hay datos para traer', err)
        })
    })
}

export function getCustomers() {
    return new Promise((res, rej) => {
        axios.get('/api/get_customers', {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.customers)
        })
        .catch(err => {
            rej('No existe el usuario', err)
        })
    })
}

export function getPedidos() {
    return new Promise((res, rej) => {
        axios.get('/api/get_pedidos', {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.pedidos)
        })
        .catch(err => {
            rej('No existe el usuario', err)
        })
    })
}

export function getStats() {
    return new Promise((res, rej) => {
        axios.get('/api/get_stats', {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.data)
        })
        .catch(err => {
            rej('No existe el usuario', err)
        })
    })
}

export function getDataEmpresa() {
    return new Promise((res, rej) => {
        axios.get('/api/get_empresa_id', {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.data)
        })
        .catch(err => {
            rej('No se puede traer los datos, press F5', err)
        })
    })
}

// PUT

export function updateStatusPedido(id) {
    return new Promise((res, rej) => {
        axios.put('/api/update_pedido', {id}, {
            headers: {
                'Authorization' : `Bearer ${store.getters.currentUser.token}`
            }
        })
        .then(response => {
            res(response.data.updated)
        })
        .catch(err => {
            rej('No se pudo cambiar el estatus', err)
        })
    })
}