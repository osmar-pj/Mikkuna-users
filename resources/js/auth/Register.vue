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
                            <h2 class="subtitle is-size-7">Con nuestra plataforma podras brindar un mejor servicio!</h2>
                        </div>
                    </div>
                    <br>
                    <div class="columns">
                        <div class="column is-4 is-offset-4">
                            <b-field type="is-primary">
                                <b-input type="text"
                                    icon="domain"
                                    placeholder="Empresa"
                                    size="is-medium"
                                    v-model="form.empresa">
                                </b-input>
                            </b-field>
                            <b-field type="is-primary">
                                <b-input type="text"
                                    icon="cellphone"
                                    placeholder="celular"
                                    size="is-medium"
                                    v-model="form.mobile">
                                </b-input>
                            </b-field>
                            <b-field label="" type="is-primary">
                                <b-select placeholder="Tipo de servicio" expanded v-model="form.servicio" icon="room-service">
                                    <option
                                        v-for="option in servicios"
                                        :value="option"
                                        :key="option.id">
                                        {{ option }}
                                    </option>
                                </b-select>
                            </b-field>
                            <b-field type="is-primary">
                                <b-input type="email"
                                    icon="email"
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
                            <b></b>
                                <div class="field">
                                    <b-checkbox v-model="form.active" required>Aceptar <a @click.prevent="terms" class="is-primary" >terminos y condiciones</a></b-checkbox>
                                </div>
                            <b-field>
                                <b-button size="is-medium" type="is-secondary" outlined rounded @click.prevent="register">REGISTRAR</b-button>
                            </b-field>
                            <b-field>
                                <h2 class="subtitle is-size-7 has-text-grey-light">Ya tengo una <a :href="`${url}/login`" class="has-text-primary">cuenta</a> </h2>
                            </b-field>
                            <b-message title="Danger" type="is-danger" aria-close-label="Close message" v-show="alarm">
                                Es importante aceptar los terminos y condiciones
                            </b-message>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <b-loading :is-full-page="true" :active.sync="loading" :can-cancel="true"></b-loading>
    </div>
</template>

<script>
import { login, register } from '../help/auth'

export default {
    data() {
        return {
            url: `${window.location.origin}`,
            form: {
                empresa: '',
                mobile: '',
                servicio: '',
                email: '',
                password: '',
                active: 0
            },
            alarm: false,
            loading: false,
            servicios: [
                'Restaurant',
                'Pasteleria_Cafeteria',
                'Rest_Campestre',
                'Pizzas',
                'Chifa',
                'Fast_Food',
                'Polleria',
                'Bar'
            ]
        }
    },
    methods: {
        register() {
            if (this.form.active) {
                this.loading = true
                register(this.$data.form)
                .then(res => {
                    if(res) {
                        this.$router.push('/login')
                        this.loading = false
                        this.$buefy.toast.open({
                        message: 'Gracias por su registro, puede iniciar sesion!',
                        type: 'is-success'
                    })
                    }
                })
                .catch(err => {
                    this.$store.commit('loginFailed', err)
                    this.loading = false
                })
            } else {
                this.alarm = true
            }
        },
        terms() {
            this.$router.push('/terms')
        }
    }
}
</script>