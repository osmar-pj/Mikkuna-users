<template>
    <div>
        <section class="hero is-light is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <figure class="image is-64x64 logo">
                        <img src="../../assets/logo2.png" alt="Logo Mikkuna">
                    </figure>
                    <div class="columns">
                        <div class="column is-4 is-offset-4">
                            <h1 class="title is-size-2 has-text-primary">MIKKUNA</h1>
                            <h2 class="subtitle is-size-7">Bienvenido, las funcionalidades te permitiran tener mejor control sobre los productos que ofreces!</h2>
                        </div>
                    </div>
                    <br>
                    <div class="columns">
                        <div class="column is-4 is-offset-4">
                            <b-field type="is-primary">
                                <b-input type="email"
                                    icon="account"
                                    placeholder="Email"
                                    size="is-medium"
                                    v-model="form.email">
                                </b-input>
                            </b-field>
                            <b-field type="is-primary">
                                <b-input type="password"
                                    placeholder="Password"
                                    password-reveal
                                    icon="lock"
                                    size="is-medium"
                                    v-model="form.password">
                                </b-input>
                            </b-field>
                            <br>
                            <br>
                            <b-field>
                                <b-button size="is-medium" type="is-secondary" outlined rounded @click.prevent="login">INGRESAR</b-button>
                            </b-field>
                            <b-field>
                                <h2 class="subtitle is-size-7 has-text-grey-light">Obtener una nueva <a :href="`${url}/register`" class="has-text-primary">cuenta</a> </h2>
                            </b-field>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <b-loading :is-full-page="true" :active.sync="loading" :can-cancel="true"></b-loading>
    </div>
</template>

<script>
import { login } from '../help/auth'

export default {
    data() {
        return {
            url: `${window.location.origin}`,
            form: {
                email: '',
                password: '',
                active: 1
            },
            loading: false
        }
    },
    methods: {
        login() {
            this.$store.dispatch('login')
            login(this.$data.form)
            .then(res => {
                this.$store.commit('loginSuccess', res)
                this.$router.push('/')
            })
            .catch(err => {
                this.$store.commit('loginFailed', err)
            })
        }
    }
}
</script>

<style lang="scss">
.logo {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>