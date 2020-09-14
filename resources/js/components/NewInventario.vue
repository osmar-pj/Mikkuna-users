<template>
    <div>
        <section class="section">
            <div class="columns">
                <div class="column is-8 is-10-mobile">
                    <h1 class="title is-size-2 has-text-primary">MIKKUNA</h1>
                    <h2 class="subtitle is-size-7">Registra los platos y bebidas que ofreces!</h2>
                    <section>
                        <b-field>
                            <b-tooltip
                                label="Haz click aqui para aumentar el numero de productos"
                                type="is-orange"
                                multilined>
                                <b-button size="is-medium" type="is-success" @click.prevent="addItem">Agregar</b-button>
                            </b-tooltip>
                        </b-field>
                        <b-table
                            :data="isEmpty ? [] : lista">
                            <template slot-scope="props">

                                <b-table-column label="Categoria">
                                    <b-field type="is-primary">
                                        <b-select v-model="props.row.categoria">
                                            <option
                                                v-for="option in categorias"
                                                :value="option.categoria"
                                                :key="option.id">
                                                {{ option.categoria }}
                                            </option>
                                        </b-select>
                                    </b-field>
                                </b-table-column>

                                <b-table-column label="Titulo">
                                    <b-field type="is-primary">
                                        <b-input v-model="props.row.titulo"></b-input>
                                    </b-field>
                                </b-table-column>

                                <b-table-column label="Precio">
                                    <b-field type="is-primary">
                                        <b-input v-model="props.row.precio" type="number" step="0.01" ></b-input>
                                    </b-field>
                                </b-table-column>

                                <b-table-column label="Image" centered>
                                    <b-field class="file">
                                        <b-upload v-model="props.row.file">
                                            <a class="button is-info">
                                                <b-icon icon="upload"></b-icon>
                                                <span>Imagen</span>
                                            </a>
                                        </b-upload>
                                        <span class="file-name" v-if="props.row.file">
                                            {{ props.row.file.name }}
                                        </span>
                                    </b-field>
                                </b-table-column>

                                <b-table-column field="date" label="Edit" centered>
                                    <b-button type="is-danger" icon-left="delete" @click.prevent=deleteItem(props.row)></b-button>
                                </b-table-column>
                            </template>

                            <template slot="empty">
                                <section class="section">
                                    <div class="content has-text-grey has-text-centered">
                                        <p >
                                            <b-icon
                                                icon="emoticon-sad"
                                                size="is-large"
                                                type="is-orange">
                                            </b-icon>
                                        </p>
                                        <p class="title">Haz click en "Agregar" para ingresar tus productos</p>
                                    </div>
                                </section>
                            </template>
                        </b-table>
                        <br>
                        <section class="section">
                            <div class="media">
                                <div class="media-left">
                                    <b-button size="is-medium" type="is-secondary" outlined rounded @click.prevent="registerNewInv">REGISTRAR</b-button>
                                </div>
                                <div class="media-content"></div>
                                <div class="media-right">
                                    <b-button outlined type="is-grey" @click="atras">Atras</b-button>
                                </div>
                            </div>
                        </section>
                    </section>
                </div>
            </div>
        </section>
        <b-loading :is-full-page="true" :active.sync="loading" :can-cancel="true"></b-loading>
    </div>
</template>

<script>
import { newInventario } from '../help/crud'

export default {
    mounted() {
        this.lista.push(this.form)
    },
    data() {
        return {
            isEmpty: false,
            lista: [],
            categorias: [
                { id: 1, categoria: 'Platos' },
                { id: 2, categoria: 'Bebidas' },
                { id: 3, categoria: 'Postres' }
            ],
            dropFiles: [],
            form: {
                categoria: '',
                titulo: '',
                descripcion: '',
                cantidad: 1,
                precio: 0,
                descuento: 0,
                file: null,
                image: ''
            },
            loading: false
        }
    },
    methods: {
        registerNewInv() {
            this.loading = true
            // Codigo para empaquetar la imagen con la data del forumulario
            const fd = new FormData()
            let i = 1
            this.lista.forEach(it => {
                fd.append(`images${i}`, it.file, it.file.name)
                i++
                it.image = it.file.name
            })
            fd.append('datas', JSON.stringify(this.lista))
            newInventario(fd)
                .then(res => {
                    if(res) {
                        this.$router.push('/inventario')
                        this.loading = false
                    }
                })
                .catch(err => {
                    this.loading = false
                })
        },
        addItem() {
            this.lista.push({
                categoria: '',
                titulo: '',
                descripcion: '',
                cantidad: 1,
                precio: 0,
                descuento: 0,
                image: ''
            })
        },
        deleteItem(id) {
            this.lista.splice(this.lista.indexOf(id), 1)
        },
        atras() {
            this.$router.go(-1)
        }
    }
}
</script>

<style lang="scss">
</style>