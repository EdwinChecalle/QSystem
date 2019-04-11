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
                        <i class="fa fa-align-justify"></i> Maestro detalle
                        <button type="button" @click="abrirModal('maestrodetalle','registrar')" class="btn btn-secondary">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarMaestroDetalle(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarMaestroDetalle(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Nombre corto</th>
                                    <th>Nombre maestro</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="detalle in arrayMadetalle" :key="detalle.n_id">
                                    <td>
                                        <button type="button" @click="abrirModal('maestrodetalle','actualizar', detalle)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="detalle.l_estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarMadetalle(detalle.n_id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarMadetalle(detalle.n_id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="detalle.c_codigodetalle"></td>
                                    <td v-text="detalle.t_nombre"></td>
                                    <td v-text="detalle.t_nombrecorto"></td>
                                    <td v-text="detalle.t_nombremacabecera"></td>
                                    <td>
                                        <div v-if="detalle.l_estado">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Maestro</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="maestro_n_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="maestro in arrayMaestrocabecera" :key="maestro.n_id" :value="maestro.n_id" v-text="maestro.t_nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Codigo </label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="c_codigodetalle" class="form-control" placeholder="Ingrese un codigo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="t_nombre" class="form-control" placeholder="Ingrese nombre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Nombre corto</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="t_nombrecorto" class="form-control" placeholder="Ingrese un nombre corto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Referencia</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="t_referencia" class="form-control" placeholder="Ingrese una referncia">
                                    </div>
                                </div>
                                <div v-show="errroMadetalle" class="from-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMadetalle" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarMaestroDetalle()">Guardar</button>
                            <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="actualizarMaestroDetalle()">Actualizar</button>
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
                madetalle_n_id : 0,
                maestro_n_id : 0,
                t_nombremacabecera : '',
                t_nombre : '',
                t_nombrecorto : '',
                t_referencia : '',
                c_codigodetalle :'',
                arrayMadetalle : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errroMadetalle : 0,
                errorMostrarMsjMadetalle : [],
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
                buscar : '',
                arrayMaestrocabecera : []
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
            listarMaestroDetalle(page, buscar, criterio) {
                let me = this;
                var url = '/maestrodetalle?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMadetalle = respuesta.maestrodetalle.data;
                    me.pagination = respuesta.pagination;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            listarMaestrocabecera(){
                let me = this;
                var url = '/maestrocabecera/listarMaestrocabecera';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMaestrocabecera = respuesta.maestrocabecera;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarMaestroDetalle(page, buscar, criterio);
            },
            registrarMaestroDetalle(){

                if(this.validarMestroDetalle()){
                    return;
                }

                let me = this;
                axios.post('/maestrodetalle/registrar',{
                    'n_id_maestrocabecera' : this.maestro_n_id,
                    'c_codigodetalle' : this.c_codigodetalle,
                    't_nombre' : this.t_nombre,
                    't_nombrecorto' : this.t_nombrecorto,
                    't_referencia' : this.t_referencia
                }).then(function (response) {
                    me.cerrarModal();
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    me.listarMaestroDetalle(1,'', 't_nombre');
                }).catch(function (error) {
                    console.log(error);
                })
            },
            actualizarMaestroDetalle(){
                if(this.validarMestroDetalle()){
                    return;
                }

                let me = this;
                axios.put('/maestrodetalle/actualizar',{
                    'n_id' :this.madetalle_n_id,
                    'n_id_maestrocabecera' : this.maestro_n_id,
                    'c_codigodetalle' : this.c_codigodetalle,
                    't_nombre' : this.t_nombre,
                    't_nombrecorto' : this.t_nombrecorto,
                    't_referencia' : this.t_referencia
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMaestroDetalle(1,'', 't_nombre');
                }).catch(function (error) {
                    console.log(error);
                })
            },
            desactivarMadetalle(madetalle_n_id){
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
                        axios.put('/maestrodetalle/desactivar',{
                            'n_id' : madetalle_n_id,
                        }).then(function (response) {
                            me.listarMaestroDetalle(1,'', 't_nombre');
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
            activarMadetalle(madetalle_n_id){
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
                        axios.put('/maestrodetalle/activar',{
                            'n_id' : madetalle_n_id,
                        }).then(function (response) {
                            me.listarMaestroDetalle(1,'', 't_nombre');
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
            validarMestroDetalle(){
                this.errroMadetalle = 0;
                this.errorMostrarMsjMadetalle = [];
                
                if(this.maestro_n_id == 0) this.errorMostrarMsjMadetalle.push("Seleccione una opción")
                if(!this.t_nombre) this.errorMostrarMsjMadetalle.push("Ingrese nombre por favor");
                if(this.errorMostrarMsjMadetalle.length) this.errroMadetalle = 1;
                return this.errroMadetalle;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.maestro_n_id = 0;
                this.t_nombremacabecera = '';
                this.c_codigodetalle = '';
                this.t_nombre = '';
                this.t_nombrecorto = '';
                this.t_referencia = '';
                this.errroMadetalle = 0;
            },
            abrirModal(modelo, action, data = []){
                switch(modelo){
                    case "maestrodetalle":
                    {
                        switch(action){
                            case "registrar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Maestro Detalle';
                                this.maestro_n_id = 0;
                                this.t_nombremacabecera = '';
                                this.c_codigodetalle = '';
                                this.t_nombre = '';
                                this.t_nombrecorto = '';
                                this.t_referencia = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Maestro Detalle';
                                this.tipoAccion = 2;
                                this.madetalle_n_id = data['n_id'];
                                this.maestro_n_id = data['n_id_maestrocabecera'];
                                this.c_codigodetalle = data['c_codigodetalle'];
                                this.t_nombre = data['t_nombre'];
                                this.t_nombrecorto = data['t_nombrecorto'];
                                this.t_referencia = data['t_referencia'];
                                break;
                            }
                        }
                    }
                }
                this.listarMaestrocabecera();
            }
        },
        mounted() {
            this.listarMaestroDetalle(1,this.buscar, this.criterio);
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
