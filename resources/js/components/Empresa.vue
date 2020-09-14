<template id="empresa">
    <div>
        <section class="hero is-light is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="columns">
                                <div class="column is-7 is-offset-2">
                                    <h1 class="title is-size-2 has-text-primary">MIKKUNA</h1>
                                    <h2 class="subtitle is-size-7">!Con nuestra plataforma podras brindar un mejor servicio!</h2>
                                </div>
                            </div>
                            <br>
                            <div class="columns">
                                <div class="column is-11 is-10-mobile">
                                    <div class="field">
                                        <b-checkbox v-model="changeDistrict">Cambiar de distrito?</b-checkbox>
                                    </div>
                                    <b-field type="is-primary" v-show="changeDistrict">
                                        <b-autocomplete
                                            rounded
                                            v-model="distrito"
                                            :data="filteredDistrict"
                                            field="name"
                                            placeholder="Elige tu distrito"
                                            icon="magnify"
                                            clearable
                                            @select="option => form.district_id = option.id">
                                            <template slot-scope="props">
                                                <div class="media">
                                                    <div class="media-content">
                                                        {{ props.option.name }}
                                                        <br>
                                                        <small>
                                                            Provincia: {{ props.option.province.name }}, <br>
                                                            Departamento: <b>{{ props.option.department.name }}</b>
                                                        </small>
                                                    </div>
                                                </div>
                                            </template>
                                            <template slot="empty">No se encontro resultados</template>
                                        </b-autocomplete>
                                    </b-field>
                                    <b-field v-show="!changeDistrict">
                                        <span>Distrito: {{ district }} </span>
                                    </b-field>
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
                                            icon="account"
                                            placeholder="Nombre del administrador"
                                            size="is-medium"
                                            v-model="form.name">
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
                                    <b-field type="is-primary">
                                        <b-input type="text"
                                            icon="map-marker"
                                            placeholder="Direccion del servicio"
                                            size="is-medium"
                                            v-model="form.address">
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
                                    <b-field >
                                        <b-checkbox-button
                                            expanded
                                            v-model="week"
                                            native-value="L"
                                            type="is-success">
                                            <span>L</span>
                                        </b-checkbox-button>

                                        <b-checkbox-button
                                            expanded 
                                            v-model="week"
                                            native-value="Ma"
                                            type="is-success">
                                            <span>M</span>
                                        </b-checkbox-button>

                                        <b-checkbox-button
                                            expanded
                                            v-model="week"
                                            native-value="Mi"
                                            type="is-success">
                                            <span>M</span>
                                        </b-checkbox-button>

                                        <b-checkbox-button 
                                            expanded
                                            v-model="week"
                                            native-value="J"
                                            type="is-success">
                                            <span>J</span>
                                        </b-checkbox-button>

                                        <b-checkbox-button
                                            expanded
                                            v-model="week"
                                            native-value="V"
                                            type="is-success">
                                            <span>V</span>
                                        </b-checkbox-button>

                                        <b-checkbox-button
                                            expanded
                                            v-model="week"
                                            native-value="S"
                                            type="is-success">
                                            <span>S</span>
                                        </b-checkbox-button>

                                        <b-checkbox-button 
                                            expanded
                                            v-model="week"
                                            native-value="D"
                                            type="is-success">
                                            <span>D</span>
                                        </b-checkbox-button>
                                    </b-field>

                                    <!-- HORA -->
                                    <div class="columns">
                                        <div class="column">
                                            <b-field type="is-primary">
                                                <b-clockpicker
                                                    rounded
                                                    placeholder="Hora de apertura"
                                                    v-model="hora_entrada"
                                                    icon="clock"
                                                    :hour-format="'12'"
                                                    editable
                                                    type="is-dark">
                                                </b-clockpicker>
                                            </b-field>
                                        </div>
                                        <div class="column">
                                            <b-field type="is-primary">
                                                <b-clockpicker
                                                    rounded
                                                    placeholder="Hora de cierre"
                                                    v-model="hora_salida"
                                                    icon="clock"
                                                    :hour-format="'12'"
                                                    editable
                                                    type="is-info">
                                                </b-clockpicker>
                                            </b-field>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <b-checkbox v-model="form.delivery">Haces delivery?</b-checkbox>
                                    </div>
                                    <b-field  type="is-primary">
                                        <b-input maxlength="40" type="textarea" placeholder="SLOGAN p.e. Nuestra comida Peruana" v-model="form.slogan"></b-input>
                                    </b-field>
                                    <b-field type="is-primary">
                                        <b-input maxlength="200" type="textarea" placeholder="DESCRIPCION: Detalla la variedad de tus servicios y platillos" v-model="form.descripcion"></b-input>
                                    </b-field>
                                    <b-field class="file">
                                        <b-upload v-model="file_imagen">
                                            <a class="button is-primary">
                                                <b-icon icon="upload"></b-icon>
                                                <span>Imagen empresa</span>
                                            </a>
                                        </b-upload>
                                        <span class="file-name" v-if="file_imagen">
                                            {{ file_imagen.name }}
                                        </span>
                                    </b-field>
                                    <b-field class="file">
                                        <b-upload v-model="file_logo">
                                            <a class="button is-secondary">
                                                <b-icon icon="upload"></b-icon>
                                                <span>Logo empresa</span>
                                            </a>
                                        </b-upload>
                                        <span class="file-name" v-if="file_logo">
                                            {{ file_logo.name }}
                                        </span>
                                    </b-field>
                                </div>
                            </div>
                        </div>
                        <div class="column is-4 is-offset-1 ">
                            <br class="is-hidden-mobile">
                            <br class="is-hidden-mobile">
                            <br class="is-hidden-mobile">
                            <br class="is-hidden-mobile">
                            <br class="is-hidden-mobile">
                            <div class="card is-light">
                                <div class="card-image">
                                    <figure class="image is-4by3">
                                        <img :src="form.imagen_empresa == null ? `${url}/images/chef.svg` : `${url}/storage/${form.imagen_empresa}`" alt="Imagen empresa">
                                        <!-- <img src='../../assets/chef.svg' alt="Imagen empresa"> -->
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-left">
                                            <figure class="image is-48x48">
                                                <img class="is-rounded" :src="form.logo_empresa == null ? `https://api.adorable.io/avatars/200/${form.empresa}.png` : `${url}/storage/${form.logo_empresa}`" alt="Logo empresa">
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <p class="title is-4 has-text-primary"> {{ form.empresa }} </p>
                                            <p class="subtitle is-6 has-text-danger-dark"> {{ form.slogan }} </p>
                                        </div>
                                    </div>

                                    <div class="content">
                                        <p class="is-size-7 has-text-grey-light">
                                            {{ form.descripcion }}
                                        </p>
                                        <b-tag rounded v-show="!!form.delivery" type="is-success">Hacemos delivery!</b-tag>
                                        <p class="is-size-7 has-text-dark" v-show="form.address">
                                            <b-icon
                                                icon="map-marker"
                                                size="is-small">
                                            </b-icon>
                                            <span> {{ form.address }} </span>
                                        </p>
                                        <h3 class="is-size-3 has-text-weight-bold has-text-grey">
                                            <!-- Mobile -->
                                            <b-icon
                                                icon="whatsapp">
                                            </b-icon>
                                            {{ form.mobile }}
                                        </h3>
                                        <h5>Abrimos los:</h5>
                                        <b-field class="btn">
                                            <b-checkbox-button
                                                class="btn"
                                                expanded
                                                v-model="week"
                                                native-value="L"
                                                type="is-twitter"
                                                size="is-small"
                                                disabled>
                                                <span>L</span>
                                            </b-checkbox-button>

                                            <b-checkbox-button
                                                expanded 
                                                v-model="week"
                                                native-value="Ma"
                                                type="is-twitter"
                                                size="is-small"
                                                disabled>
                                                <span>M</span>
                                            </b-checkbox-button>

                                            <b-checkbox-button
                                                expanded
                                                v-model="week"
                                                native-value="Mi"
                                                type="is-twitter"
                                                size="is-small"
                                                disabled>
                                                <span>M</span>
                                            </b-checkbox-button>

                                            <b-checkbox-button 
                                                expanded
                                                v-model="week"
                                                native-value="J"
                                                type="is-twitter"
                                                size="is-small"
                                                disabled>
                                                <span>J</span>
                                            </b-checkbox-button>

                                            <b-checkbox-button
                                                expanded
                                                v-model="week"
                                                native-value="V"
                                                type="is-twitter"
                                                size="is-small"
                                                disabled>
                                                <span>V</span>
                                            </b-checkbox-button>

                                            <b-checkbox-button
                                                expanded
                                                v-model="week"
                                                native-value="S"
                                                type="is-twitter"
                                                size="is-small"
                                                disabled>
                                                <span>S</span>
                                            </b-checkbox-button>

                                            <b-checkbox-button 
                                                expanded
                                                v-model="week"
                                                native-value="D"
                                                type="is-twitter"
                                                size="is-small"
                                                disabled>
                                                <span>D</span>
                                            </b-checkbox-button>
                                        </b-field>
                                        <b-field>
                                            <h6 class="has-text-grey">de {{ hora_entrada.toLocaleTimeString() }} a {{ hora_salida.toLocaleTimeString() }} </h6>
                                        </b-field>
                                    </div>
                                </div>
                            </div>
                            <section class="section">
                            <div class="media">
                                <div class="media-left">
                                    <b-button size="is-medium" type="is-primary" outlined rounded @click.prevent="update">ACTUALIZAR</b-button>
                                </div>
                                <div class="media-content"></div>
                                <div class="media-right">
                                    <b-button outlined type="is-grey" @click="atras">Atras</b-button>
                                </div>
                            </div>
                        </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <b-loading :is-full-page="true" :active.sync="loading" :can-cancel="true"></b-loading>
    </div>
</template>

<script>
import { getDataEmpresa, postUpdateEmpresa } from '../help/crud'

export default {
    el: "#empresa",
    mounted() {
        this.loading = true
        getDataEmpresa()
        .then(res => {
            this.form = res.empresa_id
            this.form.delivery = !!res.empresa_id.delivery
            this.distritos = res.distritos
            if (this.form.week) {
                this.week = res.empresa_id.week
            }
            if (!this.form.district_id) {
                this.changeDistrict = true
            }
            if(this.form.hora_entrada != null) {
                let hora = res.empresa_id.hora_entrada.split(':')[0]
                let minuto = res.empresa_id.hora_entrada.split(':')[1]
                this.hora_entrada = new Date(0,0,0,hora, minuto)
            }
            if(this.form.hora_salida != null) {
                let hora = res.empresa_id.hora_salida.split(':')[0]
                let minuto = res.empresa_id.hora_salida.split(':')[1]
                this.hora_salida = new Date(0,0,0,hora, minuto)
            }
            this.loading = false
        })
    },
    data() {
        let hora_inicio = new Date(0, 0, 0, 17, 0)
        let hora_final = new Date(0, 0, 0, 23, 0)
        return {
            url: `${window.location.origin}`,
            distritos: [],
            distrito: '',
            changeDistrict: false,
            hora_entrada: hora_inicio,
            hora_salida: hora_final,
            form: {
                empresa: '',
                name: '',
                mobile: '',
                slogan: '',
                descripcion: '',
                address: '',
                servicio: '',
                delivery: false,
                imagen_empresa: '',
                logo_empresa: '',
                district_id: '',
                week: [],
                hora_entrada: '',
                hora_salida: ''
            },
            week: ['L', 'Ma', 'Mi', 'J', 'V', '', ''],
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
            ],
            file_imagen: null,
            file_logo: null
        }
    },
    methods: {
        update() {
            this.loading = true
            this.form.week = this.week
            this.form.hora_entrada = this.hora_entrada.toTimeString().split(' ')[0]
            this.form.hora_salida = this.hora_salida.toTimeString().split(' ')[0]
            console.log(this.form.hora_entrada)
            // Codigo para empaquetar la imagen con la data del formulario
            const fd = new FormData()
            if(this.file_imagen != null) {
                fd.append('imagen_empresa', this.file_imagen, this.file_imagen.name)
                this.form.imagen_empresa = this.file_imagen.name
            }
            
            if(this.file_logo != null) {
                fd.append('logo_empresa', this.file_logo, this.file_logo.name)
                this.form.logo_empresa = this.file_logo.name
            }
            
            fd.append('data', JSON.stringify(this.form))
            postUpdateEmpresa(fd)
                .then(res => {
                    if(res) {
                        this.$router.push('/empresa')
                        getDataEmpresa()
                        .then(res => {
                            this.form = res.empresa_id
                            this.form.delivery = !!res.empresa_id.delivery
                            this.distritos = res.distritos
                            this.week = res.empresa_id.week
                            if (!this.form.distrito) {
                                this.changeDistrict = true
                            }
                            if(this.form.hora_entrada != null) {
                                let hora = res.empresa_id.hora_entrada.split(':')[0]
                                let minuto = res.empresa_id.hora_entrada.split(':')[1]
                                this.hora_entrada = new Date(0,0,0,hora, minuto)
                            }
                            if(this.form.hora_salida != null) {
                                let hora = res.empresa_id.hora_salida.split(':')[0]
                                let minuto = res.empresa_id.hora_salida.split(':')[1]
                                this.hora_salida = new Date(0,0,0,hora, minuto)
                            }
                            this.loading = false
                        })
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
    computed: {
        filteredDistrict() {
            return this.distritos.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.distrito.toLowerCase()) >= 0
            })
        },
        district() {
            let dist = ''
            this.distritos.forEach(opt => {
                if(opt.id == this.form.district_id) {
                    return dist = opt.name
                }
            })
            return dist
        }
    }
}
</script>

<style lang="scss">
.b-checkbox.checkbox[disabled] {
    opacity: 1;
}

[disabled].radio, [disabled].checkbox, fieldset[disabled] .radio, fieldset[disabled] .checkbox {
    color: #dbdbdb;
}
.button.is-twitter {
    color: #fff;
}
.card {
    color: #111;
}
</style>