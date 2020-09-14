<template>
    <div>
        <section class="section">
            <div class="columns">
                <div class="column is-6 is-offset-2">
                    <h1 class="title is-size-2 has-text-primary">MIKKUNA</h1>
                    <h2 class="subtitle is-size-7">Registra tus pedidos!</h2>
                    
                    <b-field label="" type="is-primary">
                        <b-autocomplete
                            rounded
                            v-model="form.name_user"
                            :data="filterUser"
                            placeholder="Nombre del comensal"
                            field="name_user"
                            icon-right="magnify"
                            :loading="isFetching"
                            @select="optionUser">
                            <template slot="footer">
                                <a @click="AddNewUser">
                                    <span> Agregar nuevo comensal... </span>
                                </a> 
                            </template>
                            <template slot="empty">Sin resultados</template>
                        </b-autocomplete>
                    </b-field>

                    <b-field label="Email" type="is-primary">
                        <b-input v-model="form.email" placeholder="Opcional"></b-input>
                    </b-field>

                    <hr>
                    
                    <b-field label="Buscar" type="is-primary">
                        <b-autocomplete
                            rounded
                            v-model="form.name_pedido"
                            :data="filterList"
                            placeholder="Que va a pedir el cliente?"
                            field="titulo"
                            icon-right="magnify"
                            :loading="isFetching"
                            @select="optionPedido">

                            <template slot-scope="props">
                                <div class="media">
                                    <div class="media-left">
                                        <img width="64" :src="`${url}/${props.option.image}`">
                                    </div>
                                    <div class="media-content">
                                        {{ props.option.titulo }}
                                        <br>
                                        <small>
                                            S/. {{ props.option.precio.toFixed(2) }}
                                        </small>
                                    </div>
                                </div>
                            </template>
                        </b-autocomplete>
                    </b-field>
                    
                    <b-field>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>IT</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Descuento</th>
                                    <th>Sub-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pedido, index) in form.pedidos" :key="pedido.id">
                                    <td width="30"> {{ index + 1 }} </td>
                                    <td> {{ pedido.titulo }} </td>
                                    <td> <b-numberinput v-model="pedido.cantidad" min="0"></b-numberinput> </td>
                                    <td> S/. {{ pedido.precio }} </td>
                                    <td> {{ pedido.descuento }} % </td>
                                    <td> S/. {{ (pedido.precio * pedido.cantidad).toFixed(2) }} </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> <p>TOTAL:</p> </td>
                                    <td> <p class="is-size-5 has-text-orange"><strong> S/. {{ total.toFixed(2) }} </strong></p>  </td>
                                </tr>
                            </tfoot>
                        </table>
                    </b-field>

                    <b-field>
                        <b-button type="is-info" @click="registerPedido" >Registrar pedido</b-button>
                    </b-field>
                </div>
            </div>
        </section>
        <b-loading :is-full-page="true" :active.sync="loading" :can-cancel="true"></b-loading>
    </div>
</template>

<script>
import { registerPedido } from '../help/crud'

export default {
    mounted() {
        this.$store.dispatch('getInventarios')
        this.$store.dispatch('getCustomers')
    },
    data() {
        return {
            isFetching: false,
            url: `${window.location.origin}/storage`,
            form: {
                customer_id: 0,
                name_user: '',
                name_pedido: '',
                email: '',
                pedidos: []
            },
            isEmpty: false,
            loading: false
        }
    },
    computed: {
        lista() {
            return this.$store.getters.inventarios
        },
        filterList() {
            return this.lista.filter((option) => {
                return option.titulo
                    .toString()
                    .toLowerCase()
                    .indexOf((this.form.name_pedido).toLowerCase()) >= 0
            })
        },
        customers() {
            return this.$store.getters.customers
        },
        filterUser() {
            return this.customers.filter((option) => {
                return option.name_user
                    .toString()
                    .toLowerCase()
                    .indexOf(this.form.name_user.toLowerCase()) >= 0
            })
        },
        total() {
            let suma = 0
            this.form.pedidos.forEach(i => {
                suma = (i.cantidad * i.precio) + suma
            })
            return suma
        }
    },
    methods: {
        optionPedido(val) {
            if(val != null) {
                this.form.pedidos.push(val)
            }
        },
        optionUser(val) {
            this.form.email = val.email
            this.form.customer_id = val.id
        },
        AddNewUser() {
            this.$buefy.dialog.prompt({
                message: `Nombre y Apellido`,
                inputAttrs: {
                    placeholder: 'e.g. Lalo Harenas',
                    maxlength: 20,
                    value: this.form.name_user
                },
                confirmText: 'Agregar',
                onConfirm: (value) => {
                    this.form.name_user = value
                    this.form.customer_id = 0
                    this.form.email = ''
                    // this.form.name_user.push(value)
                    // this.$refs.autocomplete.setSelected(value)
                }
            })
        },
        registerPedido() {
            this.loading = true
            registerPedido(this.$data.form)
            .then(res => {
                if(res) {
                    this.form = {
                        customer_id: 0,
                        name_user: '',
                        name_pedido: '',
                        email: '',
                        pedidos: []
                    }
                    this.$store.dispatch('getCustomers')
                    this.loading = false
                }
            })
            .catch(err => {
                this.loading = false
            })
        }
    }
}
</script>