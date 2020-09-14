<template>
    <div>
        <section class="section">
            <div class="columns">
                <div class="column is-4 is-offset-1 is-10-mobile">
                    <h1 class="title is-size-2 has-text-primary">MIKKUNA</h1>
                    <h2 class="subtitle is-size-7">Registra los platos y bebidas que ofreces!</h2>
                    <b-field>
                        <b-checkbox v-model="newCategory">Nueva categoria?</b-checkbox>
                    </b-field>
                    <b-field label="Categoria" type="is-primary" v-show="!newCategory">
                        <b-select placeholder="Selecciona una categoria" expanded v-model="form.categoria">
                            <option
                                v-for="option in categorias"
                                :value="option.categoria"
                                :key="option.id">
                                {{ option.categoria }}
                            </option>
                        </b-select>
                    </b-field>
                    <b-field label="Categoria" type="is-primary" expanded v-show="newCategory">
                        <b-input placeholder="Nueva categoria" type="text" v-model="form.categoria"></b-input>
                    </b-field>
                    <b-field label="Nombre del plato o bebida" type="is-primary" expanded>
                        <b-input placeholder="Ingresa el nombre" type="text" v-model="form.titulo"></b-input>
                    </b-field>
                    <b-field label="Descripcion" type="is-primary" expanded>
                        <b-input placeholder="Detalla el plato o bebida" type="textarea" maxlength="100" v-model="form.descripcion"></b-input>
                    </b-field>
                    <b-field label="Precio" type="is-primary" expanded>
                        <b-input placeholder="Precio en soles" type="number" step="0.01" v-model="form.precio"></b-input>
                    </b-field>
                    <b-field label="Descuento" type="is-primary" expanded>
                        <b-input placeholder="Tiene descuento especial?" type="number" step="0.01" v-model="form.descuento"></b-input>
                    </b-field>
                    <section>
                        <b-field class="file">
                            <b-upload v-model="form.file">
                                <a class="button is-info">
                                    <b-icon icon="upload"></b-icon>
                                    <span>Imagen</span>
                                </a>
                            </b-upload>
                            <span class="file-name" v-if="form.file">
                                {{ form.file.name }}
                            </span>
                        </b-field>
                    </section>
                </div>
                <div class="column is-3 is-offset-1">
                    <br>
                    <br>
                    <br><br><br><br>
                    <div class="card is-light">
                        <div class="card-image">
                            <figure class="image">
                                <img :src="`${url}${form.image}`" alt="">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <h1 class="title is-5 has-text-dark">S/. {{ form.precio | moneda }} </h1>
                                    <h2 class="subtitle is-7"> {{ form.titulo }} </h2>
                                </div>
                                <div class="media-right">
                                    <a href="">
                                        <b-icon
                                            icon="heart"
                                            type="is-primary">
                                        </b-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <section class="section">
                        <b-field>
                            <div class="media">
                                    <div class="media-left">
                                        <b-button size="is-medium" type="is-primary" outlined rounded @click.prevent="updateItem">ACTUALIZAR</b-button>
                                    </div>
                                    <div class="media-content"></div>
                                    <div class="media-right">
                                        <b-button outlined type="is-grey" @click="atras">Atras</b-button>
                                    </div>
                                </div>
                        </b-field>
                    </section>
                </div>
            </div>
        </section>
        <b-loading :is-full-page="true" :active.sync="loading" :can-cancel="true"></b-loading>
    </div>
</template>

<script>
import { newInventario, editInventario } from '../help/crud'

export default {
    mounted() {
        if (this.$route.query.data) {
            this.form = this.$route.query.data
            this.newCategory = true
        }
    },
    data() {
        return {
            url: `${window.location.origin}/storage/`,
            newCategory: false,
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
                image: '',
            },
            loading: false
        }
    },
    methods: {
        deleteDropFile(index) {
            this.dropFiles.splice(index, 1)
        },
        updateItem() {
            this.loading = true
            // Codigo para empaquetar la imagen con la data del forumulario
            const fd = new FormData()
            if(this.form.file != null) {
                fd.append('image', this.form.file, this.form.file.name)
                this.form.image = this.form.file.name
            }
            fd.append('data', JSON.stringify(this.form))
            editInventario(fd)
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
        atras() {
            this.$router.go(-1)
        }
    },
    filters: {
        moneda(val) {
            return parseFloat(val).toFixed(2)
        }
    }
}
</script>

<style lang="scss">
</style>