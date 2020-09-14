<template>
    <div class="sidebar-page">
        <section class="sidebar-layout">
             <b-sidebar
                position="fixed"
                mobile="reduce"
                expand-on-hover
                right
                type="is-primary"
                open
                fullheight
            >
                <div class="p-1">
                    <div class="block">
                    <img src="" alt="">
                    </div>
                    <b-menu class="is-custom-mobile">
                        <b-menu-list label="General">
                            <b-menu-item label="Dashboard" icon="monitor-dashboard" @click.prevent="dashboard"></b-menu-item>
                        </b-menu-list>
                        <b-menu-list label="Registro">
                            <b-menu-item label="Comidas/Bebidas" icon="food-drumstick" @click.prevent="inventario"></b-menu-item>
                            <b-menu-item label="Tomar pedidos" icon="pencil" @click.prevent="pedidos"></b-menu-item>
                        </b-menu-list>
                        <b-menu-list label="Informacion">
                            <b-menu-item label="Empresa" icon="account-circle" @click.prevent="empresa"></b-menu-item>
                        </b-menu-list>
                        <br>
                        <br>
                        <hr>
                        <b-menu-list label="Acciones">
                            <b-menu-item icon="logout" label="Cerrar sesion" @click.prevent="logout"></b-menu-item>
                        </b-menu-list>
                    </b-menu>
                </div>
            </b-sidebar>

            <div class="p-1">
                <router-view/>
            </div>
        </section>
    </div>
</template>

<script>
export default {
  data() {
    return {
    }
  },
  methods: {
      logout() {
          this.$store.commit('logout')
          this.$router.push('/login')
      },
      dashboard() {
          this.$router.push('/')
      },
      inventario() {
          this.$router.push('/inventario')
      },
      pedidos() {
          this.$router.push('/pedidos')
      },
      empresa() {
          this.$router.push('/empresa')
      }
  }
}
</script>

<style lang="scss">
.p-1 {
  padding: 1em;
}
.sidebar-page {
    display: flex;
    flex-direction: column;
    width: 100%;
    min-height: 100%;
    // min-height: 100vh;
    .sidebar-layout {
        //display: flex;
        flex-direction: row;
        min-height: 100%;
        // min-height: 100vh;
    }
}
@media screen and (max-width: 1023px) {
    .b-sidebar {
        .sidebar-content {
            &.is-mini-mobile {
                &:not(.is-mini-expand),
                &.is-mini-expand:not(:hover) {
                    .menu-list {
                        li {
                            a {
                                span:nth-child(2) {
                                    display: none;
                                }
                            }
                            ul {
                                padding-left: 0;
                                li {
                                    a {
                                        display: inline-block;
                                    }
                                }
                            }
                        }
                    }
                    .menu-label:not(:last-child) {
                        margin-bottom: 0;
                    }
                }
            }
        }
    }
}
@media screen and (min-width: 1024px) {
    .b-sidebar {
        .sidebar-content {
            &.is-mini {
                &:not(.is-mini-expand),
                &.is-mini-expand:not(:hover) {
                    .menu-list {
                        li {
                            a {
                                span:nth-child(2) {
                                    display: none;
                                }
                            }
                            ul {
                                padding-left: 0;
                                li {
                                    a {
                                        display: inline-block;
                                    }
                                }
                            }
                        }
                    }
                    .menu-label:not(:last-child) {
                        margin-bottom: 0;
                    }
                }
            }
        }
    }
}
</style>