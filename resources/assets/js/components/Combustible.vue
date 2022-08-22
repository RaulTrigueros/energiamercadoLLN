<template>
    <main class="">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Ir a Portal</a></li>
            </ol>
    <div>
        <div class="container-fluid">
          <div class="animated fadeIn">           
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                        <i class="fa fa-align-justify"></i> Consumo de Combustible
                        <button type="button" @click="abrirModal('combustible','registrar')" class="btn btn-primary">
                            &nbsp;<i class="fa fa-plus-square"></i>&nbsp;Nuevo
                        </button>
                        <button type="button" @click="abrirModal('combustible','filtrar')" class="btn btn-info">
                            &nbsp;<i class="fa fa-file-pdf-o"></i>&nbsp;Reporte de Combustible
                        </button>
                      <!--  <button type="button" @click="abrirModal('combustible','filtrar2')" class="btn btn-info">
                            &nbsp;<i class="fa fa-file-pdf-o"></i>&nbsp;Reporte de Competencias
                        </button>-->
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio" >
                               <!--   <option value="nombre">Operador/Solicitante</option>
                                  <option value="fecha">Fecha</option>
                                  <option value="descripcion">Misión Oficial</option>
                                -->  
                                  <option value="nombequipo">Equipo</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarcombustible(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarCombustible(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                     </div>
                    <br>
                      <!-- INICIO DEL LISTADO-->
                    <table class="table table-bordered table-striped table-sm table-responsive">
                      <thead>
                        <tr>
                          <th>Opciones</th>
                          <th>Fecha</th>
                          <th>Equipo</th>
                          <th>Operador</th>
                          <th>No. Requerimiento</th>
                          <th>No. Vale</th>
                          <th>No. Galones</th>
                          <th>PrecioGalón</th>
                          <th>ValorFactura</th>
                          <th>No. Factura</th>
                          <th>Misión Oficial</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="combustible in arrayCombustible" :key="combustible.id">
                           <td>
                                <button type="button" @click="abrirModal('combustible','actualizar',combustible)" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button> &nbsp;
                                <button  type="button" class="btn btn-danger btn-sm" @click="eliminarCombustible(combustible.id)">
                                    <i class="fa fa-trash"></i>
                                </button>
                          <!--  <template v-if="combustible.estado">
                                <button  type="button" class="btn btn-danger btn-sm" @click="desactivarCombustible(combustible.id)">
                                   <i class="fa fa-trash"></i>
                               </button>
                            </template>
                            <template v-else>
                                <button  type="button" class="btn btn-info btn-sm" @click="activarCombustible(combustible.id)">
                                   <i class="fa fa-check"></i>
                               </button>
                            </template>-->
                            </td>
                            <td class="align-middle">{{combustible.fecha}}</td>
                            <td class="align-middle" v-text="combustible.nombre_tipocombustible"></td> <!--Hace referencia al tipo de equipo(vehículo o maquinaria )-->
                            <td class="align-middle" v-text="combustible.nombre"></td>                         
                            <td class="align-middle" v-text="combustible.numrequerimiento"></td>
                            <td class="align-middle" v-text="combustible.numvale"></td>
                            <td class="align-middle" v-text="combustible.numgalones"></td>
                            <td class="align-middle" v-text="combustible.preciogalon"></td>
                            <td class="align-middle" v-text="combustible.valorfactura"></td>
                            <td class="align-middle" v-text="combustible.numfactura"></td>
                            <td class="align-middle" v-text="combustible.descripcion"></td>
                            <td class="align-middle">
                                <div v-if="combustible.estado">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Inactivo</span>
                                </div>
                            </td>
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
                                <label class="col-md-3 form-control-label" for="text-input">Fecha (*)</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Tipo de Equipo (*)</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idtipocombustible">
                                        <option value="0">*** Seleccione el tipo de equipo ***</option>
                                        <option v-for="tipocombustible in arrayTipocombustible" :key="tipocombustible.id" :value="tipocombustible.id" v-text="tipocombustible.nombequipo">
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Operador/Solicitante (*)</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese el nombre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Número de requerimiento (*)</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="numrequerimiento" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Número de Vale (*)</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="numvale" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Número de Galones (*)</label>
                                <div class="col-md-9">
                                    <input step="0.01" v-model="numgalones" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Precio por Galón $ (*)</label>
                                <div class="col-md-9">
                                    <input step="0.01" v-model="preciogalon" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Valor de Factura ($) </label>
                                <div class="col-md-9">
                                   <output step="0.01" class="form-control">{{numgalones*preciogalon}}</output> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Número de factura (*)</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="numfactura" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Misión Oficial</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese la descripción">
                                </div>
                            </div>
                            
                            <div v-show="errorCombustible" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjCombustible" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCombustible()" >Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCombustible()">Actualizar</button>
                    </div>
                </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div> <!--Fin del modal-->





            <!-- inicio del modal pdf-->
        <div class="modal" tabindex="-1" :class="{'fechaPdf': modal2}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de inicio </label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de fin </label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha_fin" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Tipo de equipo </label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idtipocombustible">
                                        <option value="0" disabled selected>*** Seleccione el tipo de equipo ***</option>
                                        <option v-for="tipocombustible in arrayTipocombustible" :key="tipocombustible.id" :value="tipocombustible.id" v-text="tipocombustible.nombequipo">
                                        </option>
                                    </select>
                                </div>
                            </div>
                
                            <div v-show="errorCombustible" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjCombustible" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-primary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-secondary"  @click="cargarPdf()" >Reporte completo de Consumos</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-secondary" @click="pdffechamensual(fecha,fecha_fin,'talleres')">filtrar por fecha</button>       
                        <button type="button" v-if="tipoAccion==2" class="btn btn-secondary" @click="pdffecha(fecha,fecha_fin,idtipocombustible,'talleres')">filtrar por fecha y equipo</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-secondary" @click="pdfequipo(idtipocombustible,'talleres')">filtrar por equipo</button>

                    </div>
                </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
        </div> <!--Fin del modal-->



    </div>
    </main>
</template>

<script>
import axios from 'axios'

    export default{
         data(){
            return{
                combustible_id: 0,
                idtipocombustible:0,
                fecha: '',
                nombre_tipocombustible:'',
                nombre: '',
                numrequerimiento:0,
                numvale:0,
                numgalones:0,
                preciogalon:0,
                valorfactura:0,
                numfactura:0,
                descripcion: '',
                arrayCombustible: [],
                modal :0,
                modal2:0,
                tituloModal : '',
                tipoAccion : 0,
                errorCombustible: 0,
                errorMostrarMsjCombustible: [],
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
                criterio: 'nombequipo',
                buscar: '',
                arrayTipocombustible: []
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
            listarCombustible(page, buscar, criterio){
                let me = this;
                var url = '/combustible?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCombustible = respuesta.combustibles.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            cargarPdf(){
                window.open('/combustible/generarReporteCombustible','_blank');
            },
            cargarPdfcompetencias(){
                window.open('/combustible/generarReportePrograms2','_blank');
            },
            pdfinscripcion(id){
                window.open('/combustible/pdf/'+ id);
            },
            pdffecha(inicio,fin,equipo){
                 if (this.validarFecha()){
                   return;
                }
                else{                   
              window.open('/combustible/pdf/fecha'+'/'+inicio+'/'+fin+'/'+equipo+'/');
                }       
              
            },

            pdffechamensual(inicio,fin){
                 if (this.validarFechaMensual()){
                   return;
                }
                else{                   
              window.open('/combustible/pdf/fecha'+'/'+inicio+'/'+fin+'/');
                }       
              
            },

            pdfequipo(equipo){
                 if (this.validarEquipo()){
                   return;
                }
                else{                   
              window.open('/combustible/pdf/equipo'+'/'+equipo+'/');
                }       
              
            },

            onFileChange(e) {
                this.bandImagenValida = true;
                this.errorCombustible=0;
                this.errorMostrarMsjCombustible=[];
                
                var files = e.target.files || e.dataTransfer.files;
                if(!files.length)
                    return ;
                
                if(!(files[0]['type']==='image/png' || files[0]['type']==='image/jpg' || files[0]['type']==='image/jpeg')){
                    this.errorMostrarMsjCombustible.push("Solo se permiten imagenes png, jpg y jpeg");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                    e.preventDefault();
                    this.bandImagenValida = false;
                }

                if(files[0]['size'] > 60 * 1024){
                   this.errorMostrarMsjCombustible.push("El tamaño del archivo tiene que ser menor o igual a 60 KB");
                   if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                   e.preventDefault();
                   this.bandImagenValida = false;
                }
                
                this.crearImagen(files[0]);
            },
            crearImagen(file) {
                var imagen = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                vm.imagen = e.target.result;
                };
                reader.readAsDataURL(file); 
            },
            quitarImagen: function (e) {
                this.errorCombustible=0;
                this.errorMostrarMsjCombustible=[];
                this.imagen = '';
                this.bandImagenValida = true;
            },
            selectTipocombustible(){
                let me = this;
                var url = '/tipocombustible/selectTipocombustible';
                axios.get(url).then(function (response) {
                   var respuesta = response.data;
                   me.arrayTipocombustible = respuesta.tipocombustibles;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarCombustible(page,buscar,criterio);
            },
            registrarCombustible(){

                if (this.validarCombustible()){
                   return;
                }
                
                let me = this;
                axios.post('/combustible/registrar',{
                    'fecha':this.fecha,
                    'idtipocombustible':this.idtipocombustible,
                    'nombre': this.nombre,
                    'numrequerimiento':this.numrequerimiento,
                    'numvale':this.numvale,
                    'numgalones':this.numgalones,
                    'preciogalon':this.preciogalon,
                    'valorfactura':this.numgalones*this.preciogalon, 
                    'numfactura':this.numfactura,
                    'descripcion':this.descripcion
                      
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCombustible(1,'','nombre_tipocombustible');
                }).catch(function(error){
                    console.log(error);
                });
                
            },
            actualizarCombustible(){
                
                if(this.validarCombustible()){
                    return;
                }
            
                let me = this;
                axios.put('/combustible/actualizar',{
                    'fecha':this.fecha,
                    'idtipocombustible':this.idtipocombustible,
                    'nombre': this.nombre,
                    'numrequerimiento':this.numrequerimiento,
                    'numvale':this.numvale,
                    'numgalones':this.numgalones,
                    'preciogalon':this.preciogalon,
                    'valorfactura':this.numgalones*this.preciogalon, 
                    'numfactura':this.numfactura,
                    'descripcion':this.descripcion,
                    'id':this.combustible_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCombustible(1,'','nombre_tipocombustible');
                }).catch(function(error){
                    console.log(error);
                });

            },
          /*  desactivarCombustible(id){
                swal.fire({
                title: 'Esta seguro de desactivar este Combustible?',
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

                    axios.put('/combustible/desactivar',{
                        'id': id
                    }).then(function(response){
                        me.listarCombustible(1,'','nombre_tipocombustible');
                         swal.fire(
                            'Desactivado!',
                            'Combustible desactivado con éxito!',
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
            activarCombustible(id){
                swal.fire({
                title: 'Esta seguro de activar este Combustible?',
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
                    axios.put('/combustible/activar',{
                        'id': id
                    }).then(function(response){
                        me.listarCombustible(1,'','nombre_tipocombustible');
                         swal.fire(
                            'Activado!',
                            'Combustible fue activado con éxito!',
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
            },*/
            //boton eliminar registro
            eliminarCombustible(id){
                swal.fire({
                title: 'Esta seguro de eliminar este Registro de Combustible?',
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
                    axios.put('/combustible/eliminar',{
                        'id': id
                    }).then(function(response){
                        me.listarCombustible(1,'','nombre_tipocombustible');
                        swal.fire(
                            'Eliminado!',
                            'Registro de Combustible Eliminado con éxito!',
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

            validarCombustible(){
                this.errorCombustible=0;
                this.errorMostrarMsjCombustible=[];
                
                if(this.idtipocombustible===0) this.errorMostrarMsjCombustible.push("Seleccione un tipo de Equipo");
                if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                
                if(this.errorCombustible===0){
                    if(!this.nombre) this.errorMostrarMsjCombustible.push("El nombre es necesario para el registro");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(!this.fecha) this.errorMostrarMsjCombustible.push("La Fecha es necesaria para el registro");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(!this.numrequerimiento) this.errorMostrarMsjCombustible.push("Debe ingresar un número de requerimiento");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }

                if(this.errorCombustible===0){
                    if(this.numrequerimiento<= 0) this.errorMostrarMsjCombustible.push("El número de requerimiento debe ser un número positivo");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                 if(this.errorCombustible===0){
                    if(this.fecha_inicio > this.fecha_fin) this.errorMostrarMsjCombustible.push("La fecha de inicio no puede ser mayor a la fecha de fin");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(!this.numvale) this.errorMostrarMsjCombustible.push("Debe ingresar un número de vale");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(this.numvale<= 0) this.errorMostrarMsjCombustible.push("El número de vale debe ser un número positivo");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }

                if(this.errorCombustible===0){
                    if(!this.numgalones) this.errorMostrarMsjCombustible.push("Debe ingresar la cantidad de galones");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(this.numgalones<= 0) this.errorMostrarMsjCombustible.push("El número de galones debe ser un número positivo");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }

                if(this.errorCombustible===0){
                    if(!this.preciogalon) this.errorMostrarMsjCombustible.push("Debe ingresar el precio por galón");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(this.preciogalon<= 0) this.errorMostrarMsjCombustible.push("El número de galones debe ser un número positivo");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }

              /*    if(this.errorCombustible===0){
                    if(!this.valorfactura) this.errorMostrarMsjCombustible.push("Debe ingresar el valor de factura");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
              if(this.errorCombustible===0){
                    if(this.valorfactura<= 0) this.errorMostrarMsjCombustible.push("El valor de la factura debe ser positivo");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
            */

                if(this.errorCombustible===0){
                    if(!this.numfactura) this.errorMostrarMsjCombustible.push("Debe ingresar un número de factura");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(this.numfactura<= 0) this.errorMostrarMsjCombustible.push("El número de factura debe ser un número positivo");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
              /*  if(this.errorCombustible === 0 ){    
                    if(!(!this.imagen) && (this.bandImagenValida === false)){
                        this.errorMostrarMsjCombustible.push("El archivo de imagen es inválido");
                        if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                    }
                }*/
                  
                return this.errorCombustible;
            },
            //Validaciones para filtro por fechas y equipos
            validarFecha(){
                this.errorCombustible=0;
                this.errorMostrarMsjCombustible=[];
                
                
                if(this.errorCombustible===0){
                    if(!this.fecha) this.errorMostrarMsjCombustible.push("Fecha de inicio es necesaria para filtrar");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(!this.fecha_fin) this.errorMostrarMsjCombustible.push("Fecha de fin es necesaria para filtrar");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
               
                 if(this.errorCombustible===0){
                    if(this.fecha > this.fecha_fin) this.errorMostrarMsjCombustible.push("La fecha de inicio no puede ser mayor a la fecha de fin");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }

                if(this.errorCombustible===0){
                    if(!this.idtipocombustible) this.errorMostrarMsjCombustible.push("Equipo es necesario para filtrar");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                  
                return this.errorCombustible;
            },

            //Validaciones para filtro solo por rango de fechas
            validarFechaMensual(){
                this.errorCombustible=0;
                this.errorMostrarMsjCombustible=[];
                
                
                if(this.errorCombustible===0){
                    if(!this.fecha) this.errorMostrarMsjCombustible.push("Fecha de inicio es necesaria para filtrar");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                
                if(this.errorCombustible===0){
                    if(!this.fecha_fin) this.errorMostrarMsjCombustible.push("Fecha de fin es necesaria para filtrar");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
               
                 if(this.errorCombustible===0){
                    if(this.fecha > this.fecha_fin) this.errorMostrarMsjCombustible.push("La fecha de inicio no puede ser mayor a la fecha de fin");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                  
                return this.errorCombustible;
            },


            //Validaciones para filtro solo por equipo    
            validarEquipo(){
                this.errorCombustible=0;
                this.errorMostrarMsjCombustible=[];
                

                if(this.errorCombustible===0){
                    if(!this.idtipocombustible) this.errorMostrarMsjCombustible.push("Equipo es necesario para filtrar");
                    if(this.errorMostrarMsjCombustible.length) this.errorCombustible = 1;
                }
                  
                return this.errorCombustible;
            },

            cerrarModal(){
                this.modal2=0
                this.modal = 0;
                this.tituloModal = '';
                this.fecha='';
                this.idtipocombustible=0;
                this.nombre_tipocombustible='';
                this.nombre = '';
                this.numrequerimiento=0;
                this.numvale=0;
                this.numgalones=0;
                this.preciogalon=0;
                this.valorfactura=0;
                this.numfactura=0;
                this.descripcion = '';
                this.estado = 0;
                this.errorCombustible=0;
              
            },
            abrirModal(modelo,accion,data = []){
                switch(modelo){
                    case "combustible":
                    {
                        switch(accion){
                            case "registrar":
                            {
                                this.modal = 1;
                                this.tipoAccion = 1;
                                this.tituloModal = 'Registrar Consumo de combustible';
                                this.fecha='';
                                this.idtipocombustible=0;
                                this.nombre_tipocombustible='';
                                this.nombre = '';
                                this.numrequerimiento=0;
                                this.numvale=0;
                                this.numgalones=0;
                                this.preciogalon=0;
                                this.valorfactura=0;
                                this.numfactura=0;
                                this.descripcion = '';
                                break;

                            }
                            case "actualizar":
                            {
                                
                                this.modal = 1;
                                this.tipoAccion = 2;
                                this.tituloModal = 'Actualizar Consumo de combustible';
                                this.combustible_id = data['id'];
                                this.fecha=data['fecha'];
                                this.idtipocombustible=data['idtipocombustible'];
                                this.nombre_tipocombustible='';
                                this.nombre = data['nombre'],
                                this.numrequerimiento=data['numrequerimiento'];
                                this.numvale=data['numvale'];
                                this.numgalones=data['numgalones'];
                                this.preciogalon=data['preciogalon'];
                                this.valorfactura=data['valorfactura'];
                                this.numfactura=data['numfactura'];
                                this.descripcion =data['descripcion'];
                                break;
                                    
                            }
                            case "filtrar":
                                    {
                                        this.modal2 = 1;
                                        this.tipoAccion = 2;
                                        this.tituloModal = 'filtrar reporte de combustible';
                                        this.fecha=0;
                                        this.fecha_fin=0;
                                        this.idtipocombustible=0;
                                        break;

                                    }
                                        case "filtrar2":
                                    {
                                        this.modal2 = 1;
                                        this.tipoAccion = 1;
                                        this.tituloModal = 'filtrar reporte de competencias por fecha';
                                        this.fecha_inicio='';
                                        this.fecha_fin='';
                                        this.nombre_tipocombustible='';
                                        break;

                                    }
                        
                        
                        }
                    }
                }
                this.selectTipocombustible();
            }
        },

        
        mounted() {
            this.listarCombustible(1,this.buscar,this.criterio);
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
     