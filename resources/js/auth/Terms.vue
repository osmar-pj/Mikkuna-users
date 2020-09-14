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
                            <h2 class="subtitle is-size-7">Estos son los terminos y condiciones para los empresarios y comensales que decidan usar nuestra plataforma para comercializar la carta de sus productos</h2>
                        </div>
                    </div>
                    <br>
                    <div class="columns">
                        <div class="column is-8 is-offset-2">
                            <b-message type="is-secondary">
                                MIKKUNA es una plataforma pensada y disenada con el fin de brindar a los comensales una lista de los productos que comercializan los empresarios en la industria culinaria, cuyo soporte ira actualizando las mejoras para la mejor experiencia de los usuarios, quienes al final haran uso del servicio de carta
                            </b-message>
                            <b-message type="is-secondary">
                                <h1><strong>POLITICAS DE USO</strong></h1>
                                <p>
                                    MIKKUNA permite el uso de la paltaforma bajo el concepto de uso libre y de paga, los cuales tiene sus propios beneficios y limitaciones para los empresarios, siendo mas bien de uso libre para el uso de los comensales.
                                </p>
                                <p>
                                    Las imagenes que los empresarios culinarios subiran a la plataforma, deberan ser de autoria propia o contar con el consentimiento del autor de dicha imagen.
                                </p>
                                <p>
                                    Las imagenes que se subiran deberan ser estrictamente relacionados a la industria culinaria, Mikkuna se reserva el derecho de suspender el servicio de los empresarios en caso de detectar imagenes de otra indole que tengan contenido explicito prohibido, obscenos.
                                </p>
                                <p>
                                    El texto para descripcion deberan tener relacion con las imagenes que se suban, quedando prohibido el contenido racista, ofensivo, sexual u otro que ofenda los derechos humanos
                                </p>
                            </b-message>
                            <b-message type="is-secondary">
                                <h1><strong>POLITICAS DE DATOS</strong></h1>
                                <p>
                                    MIKKUNA podra utilizar la informacion recabada en sus servidores con fines estadisticos para la mejora de la plataforma, no comercializamos datos personales y empresariales de nuestros usuarios
                                </p>
                                <p>
                                    Esta plataforma esta disenada con librerias y frameworks open source, por lo que no infringimos ninguna politica de derechos de autor.
                                </p>
                                <p>
                                    Nos hacemos responsables por el uso de los datos, la seguridad de los mismos y la correcta comunicacion hacia nuestros clientes y usuarios finales en caso de migraciones, borrado de informacion, problemas tecnicos y actualizaciones que comprometan el servicio brindado.
                                </p>
                            </b-message>
                            <div class="media">
                        <div class="media-left">
                            </div>
                            <div class="media-content"></div>
                            <div class="media-right">
                                <b-button type="is-info" @click="atras">Atras</b-button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    methods: {
        atras() {
            this.$router.go(-1)
        }
    }
}
</script>