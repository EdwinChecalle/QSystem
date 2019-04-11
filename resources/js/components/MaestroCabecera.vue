<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categorías
                        <button type="button" @click="abrirModal('maestrocabecera','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="t_nombre">Nombre</option>
                                      <option value="t_descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarMaestroCabecera(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarMaestroCabecera(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="maestro in arrayMaestro" :key="maestro.n_id">
                                    <td>
                                        <button type="button" @click="abrirModal('maestrocabecera','actualizar', maestro)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="maestro.l_estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarMaestoCabecera(maestro.n_id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarMaestroCabecera(maestro.n_id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="maestro.t_nombre"></td>
                                    <td v-text="maestro.t_descripcion"></td>
                                    <td>
                                        <div v-if="maestro.l_estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="t_nombre" class="form-control" placeholder="Ingrese nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="t_descripcion" class="form-control" placeholder="Ingrese descripcion">
                                    </div>
                                </div>
                                <div v-show="errroMaestro" class="from-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMaestro" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarMaestroCabecera()">Guardar</button>
                            <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="actualizarMaestroCabecera()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
        </main>
</template>

<script>
    export default {
        data(){
            return {
                maestro_n_id : 0,
                t_nombre : '',
                t_descripcion : '',
                arrayMaestro : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errroMaestro : 0,
                errorMostrarMsjMaestro : [],
                pagination : {
                    'total': 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page':0,
                    'from': 0, 
                    'to' :0,
                },
                offset : 3,
                criterio : 't_nombre',
                buscar : ''
            }
        },
        computed : {
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
            listarMaestroCabecera(page, buscar, criterio) {
                let me = this;
                var url = '/maestrocabecera?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMaestro = respuesta.maestrocabecera.data;
                    me.pagination = respuesta.pagination;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarMaestroCabecera(page, buscar, criterio);
            },
            registrarMaestroCabecera(){

                if(this.validarMestroCabecera()){
                    return;
                }

                let me = this;
                axios.post('/maestrocabecera/registrar',{
                    't_nombre' : this.t_nombre,
                    't_descripcion' : this.t_descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    me.listarMaestroCabecera(1,'', 't_nombre');
                }).catch(function (error) {
                    console.log(error);
                })
            },
            actualizarMaestroCabecera(){
                if(this.validarMestroCabecera()){
                    return;
                }

                let me = this;
                axios.put('/maestrocabecera/actualizar',{
                    'n_id' : this.maestro_n_id,
                    't_nombre' : this.t_nombre,
                    't_descripcion' : this.t_descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMaestroCabecera(1,'', 't_nombre');
                }).catch(function (error) {
                    console.log(error);
                })
            },
            desactivarMaestoCabecera(maestro_n_id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false,
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Estas seguro de desactivar?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/maestrocabecera/desactivar',{
                            'n_id' : maestro_n_id,
                        }).then(function (response) {
                            me.listarMaestroCabecera(1,'', 't_nombre');
                            swalWithBootstrapButtons.fire(
                                'Desactivado!',
                                'El registro ha sido desactivado con éxito.',
                                'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        })
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
            },
            activarMaestroCabecera(maestro_n_id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false,
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Estas seguro de Activar?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/maestrocabecera/activar',{
                            'n_id' : maestro_n_id,
                        }).then(function (response) {
                            me.listarMaestroCabecera(1,'', 't_nombre');
                            swalWithBootstrapButtons.fire(
                                'Activado!',
                                'El registro ha sido activado con éxito.',
                                'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        })
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
            },
            validarMestroCabecera(){
                this.errroMaestro = 0;
                this.errorMostrarMsjMaestro = [];

                if(!this.t_nombre) this.errorMostrarMsjMaestro.push("Ingrese nombre por favor");
                if(this.errorMostrarMsjMaestro.length) this.errroMaestro = 1;
                return this.errroMaestro;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.t_nombre = '';
                this.t_descripcion = '';
            },
            abrirModal(modelo, action, data = []){
                switch(modelo){
                    case "maestrocabecera":
                    {
                        switch(action){
                            case "registrar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Maestro Cabecera';
                                this.t_nombre = '';
                                this.t_descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Maestro Cabecera';
                                this.tipoAccion = 2;
                                this.maestro_n_id = data['n_id'];
                                this.t_nombre = data['t_nombre'];
                                this.t_descripcion = data['t_descripcion'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarMaestroCabecera(1,this.buscar, this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position:absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position:absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold ;
    }
</style>
