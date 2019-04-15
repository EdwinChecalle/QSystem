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
                        <i class="fa fa-align-justify"></i>Calcular Cotizacion
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de prenda</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="c_tipoprenda">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tipoprenda in arrayTipoprenda" :key="tipoprenda.c_codigodetalle" :value="tipoprenda.c_codigodetalle" v-text="tipoprenda.t_nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Modelo de prenda</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="c_modeloprenda">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="modeloprenda in arrayModeloprenda" :key="modeloprenda.c_codigodetalle" :value="modeloprenda.c_codigodetalle" v-text="modeloprenda.t_nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de tela</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="c_tipotela">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tipotela in arrayTipotela" :key="tipotela.c_codigodetalle" :value="tipotela.c_codigodetalle" v-text="tipotela.t_nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tono de tela</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="c_tonotela">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tonotela in arrayTonotela" :key="tonotela.c_codigodetalle" :value="tonotela.c_codigodetalle" v-text="tonotela.t_nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Teñido de tela</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="c_tenidotela">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tenidotela in arrayTenidotela" :key="tenidotela.c_codigodetalle" :value="tenidotela.c_codigodetalle" v-text="tenidotela.t_nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Teñido de tela</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="c_grosortela">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="grosortela in arrayGrosortela" :key="grosortela.c_codigodetalle" :value="grosortela.c_codigodetalle" v-text="grosortela.t_nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Precio</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="n_precio" class="form-control" placeholder="Ingrese precio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="t_descripcion" class="form-control" placeholder="Ingrese descripcion">
                                    </div>
                                </div>
                                <div v-show="errroCotizacion" class="from-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjCotizacion" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarCotizacion()">Guardar</button>
                            <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="actualizarCotizacion()">Actualizar</button>
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
                n_id : 0,
                c_tipoprenda : '',
                c_modeloprenda : '',
                c_tipotela : '',
                c_tonotela : '',
                c_tenidotela : '',
                c_grosortela : '',
                n_precio : 0,
                t_descripcion : '',
                arrayCotizacion : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errroCotizacion : 0,
                errorMostrarMsjCotizacion : [],
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
                arrayTipoprenda : [],
                arrayModeloprenda : [],
                arrayTipotela : [],
                arrayTonotela : [],
                arrayTenidotela : [],
                arrayGrosortela : []
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
            listarTipoprenda(n_idtabla){
                let me = this;
                var url = '/maestrodetalle/listarMaestroDetalle?n_idtabla=' + n_idtabla;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipoprenda = respuesta.maestrodetalle;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            listarModeloprenda(n_idtabla){
                let me = this;
                var url = '/maestrodetalle/listarMaestroDetalle?n_idtabla=' + n_idtabla;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayModeloprenda = respuesta.maestrodetalle;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            listarTipotela(n_idtabla){
                let me = this;
                var url = '/maestrodetalle/listarMaestroDetalle?n_idtabla=' + n_idtabla;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipotela = respuesta.maestrodetalle;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            listarTonotela(n_idtabla){
                let me = this;
                var url = '/maestrodetalle/listarMaestroDetalle?n_idtabla=' + n_idtabla;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTonotela = respuesta.maestrodetalle;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            listarTenidotela(n_idtabla){
                let me = this;
                var url = '/maestrodetalle/listarMaestroDetalle?n_idtabla=' + n_idtabla;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTenidotela = respuesta.maestrodetalle;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            listarGrosortela(n_idtabla){
                let me = this;
                var url = '/maestrodetalle/listarMaestroDetalle?n_idtabla=' + n_idtabla;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayGrosortela = respuesta.maestrodetalle;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            listarCotizacion(page, buscar, criterio) {
                let me = this;
                var url = '/cotizacion?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCotizacion = respuesta.cotizacion.data;
                    me.pagination = respuesta.pagination;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarCotizacion(page, buscar, criterio);
            },
            registrarCotizacion(){

                if(this.validarCotizacion()){
                    return;
                }

                let me = this;
                axios.post('/cotizacion/registrar',{
                    'c_tipoprenda' : this.c_tipoprenda,
                    'c_modeloprenda' : this.c_modeloprenda,
                    'c_tipotela' : this.c_tipotela,
                    'c_tonotela' : this.c_tonotela,
                    'c_tenidotela' : this.c_tenidotela,
                    'c_grosortela' : this.c_grosortela,
                    'n_precio': this.n_precio,
                    't_descripcion' : this.t_descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Se regitro exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    me.listarCotizacion(1,'', 't_nombre');
                }).catch(function (error) {
                    console.log(error);
                })
            },
            actualizarCotizacion(){
                if(this.validarCotizacion()){
                    return;
                }

                let me = this;
                axios.put('/cotizacion/actualizar',{
                    'n_id' : this.n_id,
                    'c_tipoprenda' : this.c_tipoprenda,
                    'c_modeloprenda' : this.c_modeloprenda,
                    'c_tipotela' : this.c_tipotela,
                    'c_tonotela' : this.c_tonotela,
                    'c_tenidotela' : this.c_tenidotela,
                    'c_grosortela' : this.c_grosortela,
                    'n_precio': this.n_precio,
                    't_descripcion' :this.t_descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCotizacion(1,'', 't_nombre');
                }).catch(function (error) {
                    console.log(error);
                })
            },
            desactivarCotizacion(n_id){
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
                        axios.put('/cotizacion/desactivar',{
                            'n_id' : n_id,
                        }).then(function (response) {
                            me.listarCotizacion(1,'', 't_nombre');
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
            activarCotizacion(n_id){
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
                        axios.put('/cotizacion/activar',{
                            'n_id' : n_id,
                        }).then(function (response) {
                            me.listarCotizacion(1,'', 't_nombre');
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
            validarCotizacion(){
                this.errroCotizacion = 0;
                this.errorMostrarMsjCotizacion = [];

                if(!this.n_precio) this.errorMostrarMsjCotizacion.push("Ingrese el precio por favor");
                if(this.errorMostrarMsjCotizacion.length) this.errroCotizacion = 1;
                return this.errroCotizacion;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.c_tipoprenda = '';
                this.c_modeloprenda = '';
                this.c_tipotela = '';
                this.c_tonotela = '';
                this.c_tenidotela = '';
                this.c_grosortela = '';
                this.n_precio = 0;
                this.t_descripcion = '';
                
            },
            abrirModal(modelo, action, data = []){
                switch(modelo){
                    case "cotizacion":
                    {
                        switch(action){
                            case "registrar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Cotizacion';
                                this.c_tipoprenda = '';
                                this.c_modeloprenda = '';
                                this.c_tipotela = '';
                                this.c_tonotela = '';
                                this.c_tenidotela = '';
                                this.c_grosortela = '';
                                this.t_descripcion = '';
                                this.n_precio = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Cotizacion';
                                this.tipoAccion = 2;
                                this.n_id = data['n_id'];
                                this.c_tipoprenda = data['c_tipoprenda'];
                                this.c_modeloprenda = data['c_modeloprenda'];
                                this.c_tipotela = data['c_tipotela'];
                                this.c_tonotela = data['c_tonotela'];
                                this.c_tenidotela = data['c_tenidotela'];
                                this.c_grosortela = data['c_grosortela'];
                                this.n_precio = data['n_precio'];
                                this.t_descripcion = data['t_descripcion'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarCotizacion(1,this.buscar, this.criterio);
            this.listarTipoprenda(1);
            this.listarModeloprenda(2);
            this.listarTipotela(3);
            this.listarTonotela(4)
            this.listarTenidotela(5);
            this.listarGrosortela(6);
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
