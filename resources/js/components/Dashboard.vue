<template>
    <div class="bg">
        <section class="section">
            <h1 class="title is-size-2 has-text-primary">MIKKUNA</h1>
            <h2 class="subtitle is-size-7">Gestiona tus datos de pedidos, ventas y usuarios!</h2>
            <div class="columns">
                <div class="column is-2 is-9-mobile ventas card" data-12>
                    <nav class="level">
                        <div class="level-item">
                            <div class="card-content has-text-centered">
                                <div>
                                    <p class="title has-text-light">S/. {{ stats.total_venta.toFixed(2) }} </p>
                                    <p class="heading">VENTAS</p>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="column is-2 is-9-mobile card pedidos" data-12>
                    <nav class="level">
                        <div class="level-item">
                            <div class="card-content has-text-centered">
                                <div>
                                    <p class="title has-text-light"> {{ stats.nro_pedidos }} </p>
                                    <p class="heading">PEDIDOS</p>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="column is-2 is-9-mobile card usuarios" data-12>
                    <nav class="level">
                        <div class="level-item">
                            <div class="card-content has-text-centered">
                                <div>
                                    <p class="title has-text-light"> {{ stats.nro_clientes }} </p>
                                    <p class="heading">USUARIOS</p>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column is-4" v-show="false">
                    <div class="columns">
                        <div class="column">
                            <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <apexchart width="500" type="line" :options="options" :series="series"></apexchart>
                        </div>
                    </div>
                </div>
                <div class="column is-6 is-10-mobile">
                    <b-table
                        :data="isEmpty ? [] : pedidos">
                        <template slot-scope="props">
                            <b-table-column field="id" label="Comensal">
                                {{ props.row.customer.name_user }}
                            </b-table-column>

                            <b-table-column label="Pedidos">
                                 ({{ props.row.cantidad }}) - {{ props.row.inventario.titulo }}
                            </b-table-column>

                            <b-table-column label="Status">
                                 {{ props.row.status }}
                            </b-table-column>

                            <b-table-column label="Update" centered>
                                <b-button type="is-info" icon-left="pencil" @click.prevent="update(props.row.id)"></b-button>
                            </b-table-column>
                        </template>

                        <template slot="empty">
                            <section class="section">
                                <div class="content has-text-grey has-text-centered">
                                    <p>
                                        <b-icon
                                            icon="emoticon-sad"
                                            size="is-large">
                                        </b-icon>
                                    </p>
                                    <p class="title">Aun no hay pedidos.</p>
                                </div>
                            </section>
                        </template>
                    </b-table>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Apexchart from 'vue-apexcharts'
import { updateStatusPedido } from '../help/crud'

export default {
    mounted() {
        this.$store.dispatch('getPedidos')
        this.$store.dispatch('getStats')
    },
    components: {
        Apexchart
    },
    data() {
        return {
            isEmpty: false,
            options: {
                chart: {
                    id: 'vuechart-example'
                },
                xaxis: {
                    categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                },
                colors: ['#ea907a']
            },
            series: [{
                name: 'series-1',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            }]
        }
    },
    computed: {
        pedidos() {
            return this.$store.getters.pedidos
        },
        stats() {
            return this.$store.getters.stats
        }
    },
    methods: {
        update(id) {
            updateStatusPedido(id)
            .then(res => {
                if(res) {
                    this.$store.dispatch('getPedidos')
                }
            })
        }
    }
}
</script>

<style lang="scss">
 .card[data-12] {
     border-radius: 10px;
     color: #fff;
 }
.ventas {
     background-color: #17245d;
     margin: 10px 20px 0 20px;
 }
 .pedidos {
     background-color: #7f2e73;
     margin: 10px 20px 0 20px;
 }
 .usuarios {
     background-color: #d14368;
     margin: 10px 20px 0 20px;
 }



</style>