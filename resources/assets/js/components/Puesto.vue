<template>
    <main class="">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Ir a Portal</a></li>
            </ol>
      <!--  <div>-->
            <div class="container-fluid">
            <div class="animated fadeIn">           
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                            <i class="fa fa-align-justify"></i> Gestión de Puestos
                            <button type="button" @click="abrirModal('puesto','registrar')" class="btn btn-primary">
                                &nbsp;<i class="fa fa-plus-square"></i>&nbsp;Nuevo
                            </button>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio" >
                                <!--<option value="nombre">Operador/Solicitante</option>
                                    <option value="fecha">Fecha</option> --> 
                                    <option value="numpuesto">Número de Puesto</option>
                                    <option value="area">Área</option>
                                    <!--<option value="arrendatario">Arrendatario</option>-->
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPuesto(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPuesto(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- INICIO DEL LISTADO-->
                        <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                            <th>Opciones</th>
                            <th>Arrendatario</th>
                            <th>No. de puesto</th>
                            <th>No. de contador</th>
                            <th>Área</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="puesto in arrayPuesto" :key="puesto.id">
                            <td>
                                    <button type="button" @click="abrirModal('puesto','actualizar',puesto)" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button  type="button" class="btn btn-danger btn-sm" @click="eliminarPuesto(puesto.id)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                <td class="align-middle" v-text="puesto.nombre_persona"></td> 
                                <td class="align-middle" v-text="puesto.numpuesto"></td>                         
                                <td class="align-middle" v-text="puesto.numcontador"></td>
                                <td class="align-middle" v-text="puesto.area"></td>
                            </tr>
                        </tbody>
                        </table>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Anterior</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                    </li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Siguiente</a>
                                    </li>
                                </ul>
                            </nav>
                        <!-- FIN DEL LISTADO-->
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
                <!--Inicio del modal agregar/actualizar-->
            <div class="modal" tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre de Arrendatario (*)</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idpersona">
                                            <option value="0" disabled selected>Selecciona un Arrendatario</option>
                                            <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id" v-text="persona.nombre">
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Número de puesto (*)</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="numpuesto" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Número de contador (*)</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="numcontador" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Área</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="area">
                                                <option value="0" disabled>Selecciona una opción</option>
                                                <option value="bazar">Bazares</option>
                                                <option value="cereal">Cereales</option>
                                                <option value="farmacia">Farmacias</option>
                                                <option value="mixto">Mixtos</option>
                                                <option value="verdura">Verduras</option>
                                                <option value="lacteo">Lacteos</option>
                                                <option value="carne">Carnes</option>
                                                <option value="marisco">Mariscos</option>
                                                <option value="comedores">Comedores</option>
                                                <option value="anclas">Anclas</option>
                                                <option value="chaleth">Chaleths</option>
                                            </select>                                        
                                        </div>
                                </div>
                                <div v-show="errorPuesto" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPuesto" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer"> 
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPuesto()" >Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPuesto()">Actualizar</button>
                        </div>
                    </div> <!-- /.modal-content -->
                </div> <!-- /.modal-dialog -->
            </div> <!--Fin del modal-->
        </div>
    </main>
</template>

<script>
//import axios from 'axios'

    export default{
         data(){
            return{
                puesto_id: 0,
                idpersona:0,
                nombre_persona:'',
                numpuesto:0,
                numcontador:0,
                area:'',
                arrayPuesto: [],
                modal :0,
                modal2:0,
                tituloModal : '',
                tipoAccion : 0,
                errorPuesto: 0,
                errorMostrarMsjPuesto: [],
            //    bandImagenValida: false,
                pagination:{
                    'total' : 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to' :0,
                },
                offset : 3,
                criterio: 'numpuesto',
                buscar: '',
                arrayPersona: []
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page -this.offset;
                if(from<1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from ++;
                }

                return pagesArray;
            }  
        },
        methods : {
            listarPuesto(page, buscar, criterio){
                let me = this;
                var url = '/puesto?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPuesto = respuesta.puestos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            
            selectPersona(){
                let me = this;
                var url = '/persona/selectPersona';
                axios.get(url).then(function (response) {
                   var respuesta = response.data;
                   me.arrayPersona = respuesta.personas;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarPuesto(page,buscar,criterio);
            },
            registrarPuesto(){

                if (this.validarPuesto()){
                   return;
                }
                
                let me = this;
                axios.post('/puesto/registrar',{
                    'idpersona':this.idpersona,
                    'numpuesto':this.numpuesto,
                    'numcontador':this.numcontador,
                    'area':this.area
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPuesto(1,'','numpuesto');
                }).catch(function(error){
                    console.log(error);
                });
                
            },
            actualizarPuesto(){
                
                if(this.validarPuesto()){
                    return;
                }
            
                let me = this;
                axios.put('/puesto/actualizar',{
                    'idpersona':this.idpersona,
                    'numpuesto':this.numpuesto,
                    'numcontador':this.numcontador,
                    'area':this.area,
                    'id':this.puesto_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPuesto(1,'','numpuesto');
                }).catch(function(error){
                    console.log(error);
                });

            },
             eliminarPuesto
             (id){
                swal.fire({
                title: 'Esta seguro de eliminar este Puesto?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: "#d33",
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                    let me = this;
                    axios.put('/puesto/eliminar',{
                        'id': id
                    }).then(function(response){
                        me.listarPuesto(1,'','nombre_persona');
                        swal.fire(
                            'Eliminado!',
                            'Registro de Puesto Eliminado con éxito!',
                            'success'
                            )
                    }).catch(function(error){
                        console.log(error);
                    });
                   
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                }
                })
            },
            validarPuesto(){
                this.errorPuesto=0;
                this.errorMostrarMsjPuesto=[];
                
                if(this.idpersona===0) this.errorMostrarMsjPuesto.push("Seleccione un Arrendatario");
                if(this.errorMostrarMsjPuesto.length) this.errorPuesto = 1;
                
                if(this.errorPuesto===0){
                    if(!this.numpuesto) this.errorMostrarMsjPuesto.push("Debe ingresar un número de puesto");
                    if(this.errorMostrarMsjPuesto.length) this.errorPuesto = 1;
                }

                if(this.errorPuesto===0){
                    if(!this.numcontador) this.errorMostrarMsjPuesto.push("Debe ingresar un número de contador");
                    if(this.errorMostrarMsjPuesto.length) this.errorPuesto = 1;
                }

                if(this.errorPuesto===0){
                    if(!this.area) this.errorMostrarMsjPuesto.push("Debe seleccionar el área de venta");
                    if(this.errorMostrarMsjPuesto.length) this.errorPuesto = 1;
                }
               
                return this.errorPuesto;
            },

            cerrarModal(){
                this.modal2=0
                this.modal = 0;
                this.tituloModal = '';
                this.idpersona=0;
                this.nombre_persona='';
                this.numpuesto=0;
                this.numcontador=0;
                this.area = '';
                this.errorPuesto=0;
              
            },
            abrirModal(modelo,accion,data = []){
                switch(modelo){
                    case "puesto":
                    {
                        switch(accion){
                            case "registrar":
                            {
                                this.modal = 1;
                                this.tipoAccion = 1;
                                this.tituloModal = 'Registrar Puesto';
                                this.idpersona=0;
                                this.nombre_persona='';
                                this.numpuesto=0;
                                this.numcontador=0;
                                this.area = '';
                                break;

                            }
                            case "actualizar":
                            {
                                
                                this.modal = 1;
                                this.tipoAccion = 2;
                                this.tituloModal = 'Actualizar Puesto';
                                this.puesto_id = data['id'];
                                this.idpersona= data['idpersona'];
                                this.nombre_persona=data['nombre_persona'];
                                this.numpuesto=data['numpuesto'];
                                this.numcontador=data['numcontador'];
                                this.area=data['area'];
                                break;
                            }
                           
                        
                        }
                    }
                }
                this.selectPersona();
            },
        },
      
        mounted() {
            this.listarPuesto(1,this.buscar,this.criterio);
        }            
    }
</script>

<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        overflow-y: scroll;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }

    .fechaPdf{
        display: list-item !important;
        overflow-y: scroll;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    .img{
        width: 30%;
        margin: auto;
        display: block;
        margin-bottom: 10px;
    }
</style>
     