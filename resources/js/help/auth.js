import axios from 'axios'

export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/login', credentials)
        .then(response => {
            res(response.data)
        })
        .catch(err => {
            rej('Revisa tu email o password', err)
        })
    })
}

export function getLocalUser() {
    const userStr = localStorage.getItem('user')

    if(!userStr) {
        return null
    }

    return JSON.parse(userStr)
}

export function register(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/register', credentials)
        .then(response => {
            res(response.data)
        })
        .catch(err => {
            rej('Falta completar los campos', err)
        })
    })
}