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
                        <i class="fa fa-align-justify"></i> Consumo de Energía
                        <button type="button" @click="abrirModal('energia','registrar')" class="btn btn-primary">
                            &nbsp;<i class="fa fa-plus-square"></i>&nbsp;Nuevo
                        </button>
                        <button type="button" @click="abrirModal('energia','filtrar')" class="btn btn-info">
                            &nbsp;<i class="fa fa-file-pdf-o"></i>&nbsp;Reporte de Energia Eléctrica
                        </button>
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio" >
                                  <option value="numpuesto">Número de Puesto</option>
                                 <!-- <option value="nombre">Arrendatario</option>
                                  <option value="estado">Estado</option>-->
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarEnergia(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarEnergia(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                     </div>
                    <br>
                      <!-- INICIO DEL LISTADO-->
                    <table class="table table-bordered table-striped table-sm table-responsive">
                      <thead>
                        <tr>
                          <th style="text-align: center" >Opciones</th>
                          <th style="text-align: center" >Arrendatario</th>
                          <th style="text-align: center" >No. de puesto</th>
                          <th style="text-align: center" >No. de contador</th>
                          <th style="text-align: center" >Área</th>
                          <th style="text-align: center" >Lec. Anterior</th>
                          <th style="text-align: center" >Lec. Actual</th>
                          <th style="text-align: center" >Fecha Vencimiento</th>
                          <th style="text-align: center" >Mes Facturado</th>
                          <th style="text-align: center" >Consumo</th>
                          <th style="text-align: center" >Total a pagar</th>
                          <th style="text-align: center" >Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="energia in arrayEnergia" :key="energia.id">
                           <td>
                                <button type="button" @click="pdfFactura(energia.id)" class="btn btn-info btn-sm">
                                            <i class="fa fa-file-pdf-o"></i>
                                </button>
                                <button type="button" @click="abrirModal('energia','actualizar',energia)" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <template v-if="energia.estado">
                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivarEnergia(energia.id)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-info btn-sm" @click="activarEnergia(energia.id)">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </template>
                            </td>
                            <td class="align-middle" v-text="energia.nombre_persona"></td> 
                            <td class="align-middle" v-text="energia.numpuesto"></td>                         
                            <td class="align-middle" v-text="energia.numcontador"></td>
                            <td class="align-middle" v-text="energia.area"></td>
                            <td class="align-middle" v-text="energia.lecturaanterior"></td>
                            <td class="align-middle" v-text="energia.lecturaactual"></td>
                            <td class="align-middle">{{energia.fechavencimiento}}</td>
                            <td class="align-middle">{{energia.mesfacturado}}</td>
                            <td class="align-middle" v-text="energia.consumo"></td>
                            <td class="align-middle" v-text="energia.totalpago"></td>
                            <td class="align-middle">
                                <div v-if="energia.estado">
                                    <span class="badge badge-success">Sin pago</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Pagado</span>
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
                                <label class="col-md-3 form-control-label" for="text-input">Número de Puesto (*)</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idpuesto">
                                        <option value="0" disabled selected>Selecciona un Puesto</option>
                                        <option v-for="puesto in arrayPuesto" :key="puesto.id" :value="puesto.id" v-text="puesto.numpuesto"></option>
                                    </select>
                                </div>  
                            </div>
                           <!-- <div class="form-group row">
                                 <label class="col-md-3 form-control-label" for="text-input">Nombre de Arrendatario (*)</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idpuesto">
                                        <option value="0" disabled selected>Arrendatario</option>
                                        <option v-for="energia in arrayEnergia" :key="energia.id" :value="energia.id" v-text="energia.nombre_persona">
                                        </option>
                                    </select>
                                </div> 
                            </div>-->
                            <div class="form-group row">
                                 <label class="col-md-3 form-control-label" for="text-input">Número de Contador (*)</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idpuesto">
                                        <option value="0" disabled selected>Número de contador</option>
                                        <option v-for="puesto in arrayPuesto" :key="puesto.id" :value="puesto.id" v-text="puesto.numcontador">
                                        </option>
                                    </select>
                                </div> 
                            </div>
                            
                            <div class="form-group row">
                                 <label class="col-md-3 form-control-label" for="text-input">Área(*)</label>
                                <div class="col-md-9">   
                                    <select class="form-control" v-model="idpuesto">
                                        <option value="0" disabled selected>Área</option>
                                        <option v-for="puesto in arrayPuesto" :key="puesto.id" :value="puesto.id" v-text="puesto.area">
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Lectura anterior Kwh (*)</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="lecturaanterior" class="form-control" placeholder="cantidad kwh">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Lectura actual Kwh (*)</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="lecturaactual" class="form-control" placeholder="cantidad kwh">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha Vencimiento(*)</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fechavencimiento" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha Inicio(*)</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fechainicio" class="form-control" placeholder="">
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha Fin(*)</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fechafin" class="form-control" placeholder="">
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Mes Facturado(*)</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="mesfacturado" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Emision(*)</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fechaemision" class="form-control" placeholder="">
                                </div>
                            </div>
                            <hr>
                            <h4>Detalles de consumo</h4>
                            <hr>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Consumo del Mes (*)</label>
                                <div class="col-md-9">
                                    <output step="0.01" class="form-control" placeholder="">{{consumo=lecturaactual-lecturaanterior}} kwh</output>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Costo por Kwh (*)</label>
                                <div class="col-md-9">
                                    <output step="0.01" class="form-control" placeholder="">$ {{costokwh=0.16}}</output>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Total a pagar</label>
                                <div class="col-md-9">
                                   <output step="0.01" class="form-control">$ {{consumo*0.16}}</output> 
                                </div>
                            </div>
                            <div v-show="errorEnergia" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjEnergia" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEnergia()" >Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEnergia()">Actualizar</button>
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
                                    <input type="date" v-model="fechainicio" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de fin </label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fechafin" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Número de puesto</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="numpuesto" class="form-control" placeholder="">
                                </div>
                            </div>
                
                            <div v-show="errorEnergia" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjEnergia" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-primary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-secondary"  @click="cargarPdf()" >Reporte completo de Consumos</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-secondary" @click="pdffechamensual(fechainicio,fechafin,'energias')">filtrar por fecha</button>     
                        <button type="button" v-if="tipoAccion==2" class="btn btn-secondary" @click="pdfpago()">filtrar No pagados</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-secondary" @click="pdfpuesto(numpuesto,'energias')">filtrar por puesto</button>

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
                energia_id: 0,
                idpersona:0,
                idpuesto:0,
                nombre_persona:'',
                numpuesto:0,
                numcontador:0,
                area:'',
                lecturaanterior:0,
                lecturaactual:0,
                costokwh:0,
                fechavencimiento: '',
                fechainicio: '',
                fechafin: '',
                mesfacturado: '',
                fechaemision: '',
                consumo:0,
                totalpago:0,
                arrayEnergia: [],
                modal :0,
                modal2:0,
                tituloModal : '',
                tipoAccion : 0,
                errorEnergia: 0,
                errorMostrarMsjEnergia: [],
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
                arrayPuesto: []
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
            listarEnergia(page, buscar, criterio){
                let me = this;
                var url = '/energia?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEnergia = respuesta.energias.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            cargarPdf(){
                window.open('/energia/generarReporteEnergia','_blank');
            },
            
            pdfpago(){           
              window.open('/energia/pdf/nopagado');
            },

            pdffechamensual(inicio,fin){
                 if (this.validarFechaMensual()){
                   return;
                }
                else{                   
              window.open('/energia/pdf/fecha'+'/'+inicio+'/'+fin+'/');
                }       
              
            },

            pdfpuesto(puesto){
                 if (this.validarPuesto()){
                   return;
                }
                else{                   
              window.open('/energia/pdf/puesto'+'/'+puesto+'/');
                }       
              
            },

            pdfFactura(id){
                window.open('/energia/pdfFactura/'+ id ,'_blank');
            },

            onFileChange(e) {
                this.bandImagenValida = true;
                this.errorEnergia=0;
                this.errorMostrarMsjEnergia=[];
                
                var files = e.target.files || e.dataTransfer.files;
                if(!files.length)
                    return ;
                
                if(!(files[0]['type']==='image/png' || files[0]['type']==='image/jpg' || files[0]['type']==='image/jpeg')){
                    this.errorMostrarMsjEnergia.push("Solo se permiten imagenes png, jpg y jpeg");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                    e.preventDefault();
                    this.bandImagenValida = false;
                }

                if(files[0]['size'] > 60 * 1024){
                   this.errorMostrarMsjEnergia.push("El tamaño del archivo tiene que ser menor o igual a 60 KB");
                   if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
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
                this.errorEnergia=0;
                this.errorMostrarMsjEnergia=[];
                this.imagen = '';
                this.bandImagenValida = true;
            },
            selectPuesto(){
                let me = this;
                var url = '/puesto/selectPuesto';
                axios.get(url).then(function (response) {
                   var respuesta = response.data;
                   me.arrayPuesto = respuesta.puestos;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },

           
            cambiarPagina(page,buscar,criterio){
                let me = this;
                me.pagination.current_page = page;
                me.listarEnergia(page,buscar,criterio);
            },
            registrarEnergia(){

                if (this.validarEnergia()){
                   return;
                }
                
                let me = this;
                axios.post('/energia/registrar',{
                    'idpuesto':this.idpuesto,
                    'nombre_persona':this.nombre_persona,
                    'numpuesto':this.numpuesto,
                    'numcontador':this.numcontador,
                    'area':this.area,
                    'lecturaanterior':this.lecturaanterior,
                    'lecturaactual':this.lecturaactual,
                    'fechavencimiento':this.fechavencimiento,
                    'fechainicio':this.fechainicio,
                    'fechafin':this.fechafin,
                    'mesfacturado':this.mesfacturado,
                    'fechaemision':this.fechaemision,
                    'consumo':this.consumo,
                    'costokwh':this.costokwh,
                    'totalpago':this.consumo*0.16,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarEnergia(1,'','numpuesto');
                }).catch(function(error){
                    console.log(error);
                });
                
            },
            actualizarEnergia(){
                if(this.validarEnergia()){
                    return;
                }
            
                let me = this;
                axios.put('/energia/actualizar',{
                    'idpuesto':this.idpuesto,
                    'nombre_persona':this.nombre_persona,
                    'numpuesto':this.numpuesto,
                    'numcontador':this.numcontador,
                    'area':this.area,
                    'lecturaanterior':this.lecturaanterior,
                    'lecturaactual':this.lecturaactual,
                    'fechavencimiento':this.fechavencimiento,
                    'fechainicio':this.fechainicio,
                    'fechafin':this.fechafin,
                    'mesfacturado':this.mesfacturado,
                    'fechaemision':this.fechaemision,
                    'consumo':this.consumo,
                    'costokwh':this.costokwh,
                    'totalpago':this.consumo*0.16,
                    'id':this.energia_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarEnergia(1,'','numpuesto');
                }).catch(function(error){
                    console.log(error);
                });

            },
            desactivarEnergia(id){
                swal.fire({
                title: 'Marcar factura como pagada?',
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
                    axios.put('/energia/desactivar',{
                        'id': id
                    }).then(function(response){
                        me.listarEnergia(1,'','nombre_persona');
                         swal.fire(
                            'Pagado!',
                            'Esta Factura ha sido pagada!',
                            'success'
                            )
                    }).catch(function(error){
                        console.log(error);
                    });
                   
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                }
                })
            },
            activarEnergia(id){
                Swal.fire({
                title: 'Está segura de Revertir el estado de la factura?',
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
                    axios.put('/energia/activar',{
                        'id': id
                    }).then(function(response){
                        me.listarEnergia(1,'','nombre_persona');
                         Swal.fire(
                            'Realizado!',
                            'Esta factura no ha sido pagada!',
                            'success'
                            )
                    }).catch(function(error){
                        console.log(error);
                    });
                   
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                }
                })
            },

            validarEnergia(){
                this.errorEnergia=0;
                this.errorMostrarMsjEnergia=[];
                
                if(this.idpuesto===0) this.errorMostrarMsjEnergia.push("Ingrese un número de puesto");
                if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                
             /*   if(this.errorEnergia===0){
                    if(!this.numpuesto) this.errorMostrarMsjEnergia.push("Debe ingresar un número de puesto");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

                if(this.errorEnergia===0){
                    if(!this.numcontador) this.errorMostrarMsjEnergia.push("Debe ingresar un número de contador");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

                if(this.errorEnergia===0){
                    if(!this.area) this.errorMostrarMsjEnergia.push("Debe seleccionar el área de venta");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }*/
                
                if(this.errorEnergia===0){
                    if(!this.lecturaanterior) this.errorMostrarMsjEnergia.push("Debe ingresar la lectura de contador anterior");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

                if(this.errorEnergia===0){
                    if(!this.lecturaactual) this.errorMostrarMsjEnergia.push("Debe ingresar la lectura de contador actual");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

                if(this.errorEnergia===0){
                    if(!this.fechavencimiento) this.errorMostrarMsjEnergia.push("La Fecha de vencimiento es necesaria para el registro");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

                 if(this.errorEnergia===0){
                    if(!this.mesfacturado) this.errorMostrarMsjEnergia.push("Debe ingresar el mes de facturación");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

                 if(this.errorEnergia===0){
                    if(!this.fechaemision) this.errorMostrarMsjEnergia.push("Debe ingresar la fecha de emisión de factura");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

              /*  if(this.errorEnergia===0){
                    if(this.numcontador<= 0) this.errorMostrarMsjEnergia.push("El número de contador debe ser un número positivo");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

                 if(this.errorEnergia===0){
                    if(this.numpuesto<= 0) this.errorMostrarMsjEnergia.push("El número de puesto debe ser un número positivo");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }*/
                
                 if(this.errorEnergia===0){
                    if(this.fechainicio > this.fechafin) this.errorMostrarMsjEnergia.push("La fecha de inicio no puede ser mayor a la fecha de fin");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
                
                if(this.errorEnergia===0){
                    if(this.costokwh<= 0) this.errorMostrarMsjEnergia.push("El costo por kwh debe ser un número positivo");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
    

                if(this.errorEnergia===0){
                    if(this.lecturaanterior<= 0) this.errorMostrarMsjEnergia.push("El valor de lectura anterior debe ser un número positivo");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
                
                if(this.errorEnergia===0){
                    if(this.lecturaactual<= 0) this.errorMostrarMsjEnergia.push("El valor de lectura actual debe ser un número positivo");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
                  
                return this.errorEnergia;
            },
            //Validaciones para filtro por fechas y equipos
            validarFecha(){
                this.errorEnergia=0;
                this.errorMostrarMsjEnergia=[];
                
                
                if(this.errorEnergia===0){
                    if(!this.fechainicio) this.errorMostrarMsjEnergia.push("Fecha de inicio es necesaria para filtrar");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
                
                if(this.errorEnergia===0){
                    if(!this.fechafin) this.errorMostrarMsjEnergia.push("Fecha de fin es necesaria para filtrar");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
               
                 if(this.errorEnergia===0){
                    if(this.fechainicio> this.fechafin) this.errorMostrarMsjEnergia.push("La fecha de inicio no puede ser mayor a la fecha de fin");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }

               /* if(this.errorEnergia===0){
                    if(!this.idtipocombustible) this.errorMostrarMsjEnergia.push("Equipo es necesario para filtrar");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }*/
                  
                return this.errorEnergia;
            },

            //Validaciones para filtro solo por rango de fechas
            validarFechaMensual(){
                this.errorEnergia=0;
                this.errorMostrarMsjEnergia=[];
                
                
                if(this.errorEnergia===0){
                    if(!this.fechainicio) this.errorMostrarMsjEnergia.push("Fecha de inicio es necesaria para filtrar");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
                
                if(this.errorEnergia===0){
                    if(!this.fechafin) this.errorMostrarMsjEnergia.push("Fecha de fin es necesaria para filtrar");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
               
                 if(this.errorEnergia===0){
                    if(this.fechainicio > this.fechafin) this.errorMostrarMsjEnergia.push("La fecha de inicio no puede ser mayor a la fecha de fin");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
                  
                return this.errorEnergia;
            },


            //Validaciones para filtro solo por puesto    
            validarPuesto(){
                this.errorEnergia=0;
                this.errorMostrarMsjEnergia=[];
                
                if(this.errorEnergia===0){
                    if(!this.numpuesto) this.errorMostrarMsjEnergia.push("El número de puesto es necesario para filtrar");
                    if(this.errorMostrarMsjEnergia.length) this.errorEnergia = 1;
                }
                  
                return this.errorEnergia;
            },

            cerrarModal(){
                this.modal2=0
                this.modal = 0;
                this.tituloModal = '';
                this.idpuesto=0;
                this.idpersona=0;
                this.nombre_persona='';
                this.numpuesto=0;
                this.numcontador=0;
                this.area = '';
                this.lecturaanterior=0;
                this.lecturaactual=0;
                this.fechavencimiento='';
                this.fechainicio='';
                this.fechafin='';
                this.mesfacturado='';
                this.fechaemision='';
                this.consumo=0;
                this.costokwh=0;
                this.totalpago=0;
                this.estado = 0;
                this.errorEnergia=0;
              
            },
            abrirModal(modelo,accion,data = []){
                switch(modelo){
                    case "energia":
                    {
                        switch(accion){
                            case "registrar":
                            {
                                this.modal = 1;
                                this.tipoAccion = 1;
                                this.tituloModal = 'Registrar Consumo de energía';
                                this.idpuesto=0;
                                this.idpersona=0;
                                this.nombre_persona='';
                                this.numpuesto=0;
                                this.numcontador=0;
                                this.area = '';
                                this.lecturaanterior=0;
                                this.lecturaactual=0;
                                this.fechavencimiento='';
                                this.fechainicio='';
                                this.fechafin='';
                                this.mesfacturado='';
                                this.fechaemision='';
                                this.consumo=0;
                                this.costokwh=0;
                                this.totalpago=0;
                                break;

                            }
                            case "actualizar":
                            {
                                
                                this.modal = 1;
                                this.tipoAccion = 2;
                                this.tituloModal = 'Actualizar Consumo de energía';
                                this.energia_id = data['id'];
                                this.idpuesto= data['idpuesto'];
                                this.idpersona= data['idpersona'];
                                this.nombre_persona=data['nombre_persona'];
                                this.numpuesto=data['numpuesto'];
                                this.numcontador=data['numcontador'];
                                this.area =data['area'];
                                this.lecturaanterior=data['lecturaanterior'];
                                this.lecturaactual=data['lecturaactual'];;
                                this.fechavencimiento=data['fechavencimiento'];
                                this.fechainicio=data['fechainicio'];
                                this.fechafin=data['fechafin'];
                                this.mesfacturado=data['mesfacturado'];
                                this.fechaemision=data['fechaemision'];
                                this.consumo=data['consumo'];
                                this.costokwh=data['costokwh']
                                this.totalpago=data['totalpago'];
                                break;
                                    
                            }
                            case "filtrar":
                                    {
                                        this.modal2 = 1;
                                        this.tipoAccion = 2;
                                        this.tituloModal = 'filtrar reporte de energía';
                                        this.fechainicio=0;
                                        this.fechafin=0;
                                        this.idpuesto=0;
                                        break;

                                    }
                                        case "filtrar2":
                                    {
                                        this.modal2 = 1;
                                        this.tipoAccion = 1;
                                        this.tituloModal = 'filtrar reporte de competencias por fecha';
                                        this.fechainicio='';
                                        this.fechafin='';
                                        this.nombre_persona='';
                                        break;

                                    }
                        
                        
                        }
                    }
                }
                //this.selectPersona();
                this.selectPuesto();
            },
        },
      
        mounted() {
            this.listarEnergia(1,this.buscar,this.criterio);
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
     