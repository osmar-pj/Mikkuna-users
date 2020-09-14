<template>
    <div>
        <section class="section">
            <div class="columns">
                <div class="column is-10 is-10-mobile">
                    <h1 class="title is-size-2 has-text-primary">MIKKUNA</h1>
                    <h2 class="subtitle is-size-7">La lista completa que ofreces!</h2>
                    <b-field>
                            <b-tooltip
                                label="Haga click para agregar nuevos productos"
                                type="is-orange"
                                multilined>
                                <b-button type="is-success" @click.prevent="newInventario">Nuevo</b-button>
                            </b-tooltip>
                        </b-field>
                    <b-table
                        :data="isEmpty ? [] : inventarios">
                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="first_name" label="Categoria">
                                {{ props.row.categoria }}
                            </b-table-column>

                            <b-table-column field="last_name" label="Descripcion">
                                <strong>{{ props.row.titulo }} </strong> <br> {{ props.row.descripcion }}
                            </b-table-column>

                            <b-table-column field="date" label="Precio" centered>
                                S/. {{ props.row.precio.toFixed(2) }}
                            </b-table-column>

                            <b-table-column field="date" label="Descuento" centered>
                                {{ props.row.descuento | percent }}
                            </b-table-column>

                            <b-table-column label="Image" centered>
                                <figure class="image is-64x64">
                                    <img :src="`${url}/${props.row.image}`">
                                </figure>
                            </b-table-column>

                            <b-table-column field="date" label="Edit" centered>
                                <b-button type="is-info" icon-left="pencil" @click.prevent=editInventario(props.row)></b-button>
                            </b-table-column>
                        </template>

                        <template slot="empty">
                            <section class="section">
                                <div class="content has-text-grey has-text-centered">
                                    <p >
                                        <b-icon
                                            icon="emoticon-sad"
                                            size="is-large"
                                            type="is-primary">
                                        </b-icon>
                                    </p>
                                    <p class="title">Aun no se registro ningun plato o bebida.</p>
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
export default {
    mounted() {
        this.$store.dispatch('getInventarios')
    },
    data() {
        return {
            url: `${window.location.origin}/storage/`,
            isEmpty: false,
        }
    },
    methods: {
        newInventario() {
            this.$router.push('new_inventario')
        },
        editInventario(data) {
            this.$router.push({ path: '/edit_inventario', query: { data } })
        }
    },
    computed: {
        inventarios() {
            return this.$store.getters.inventarios
        }
    },
    filters: {
        percent(val) {
            return `${val} %`
        }
    }
}
</script>

<style lang="scss">
    
</style>