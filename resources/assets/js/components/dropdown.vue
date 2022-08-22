import axios from 'axios';
<template>
    <div class="container" style="background-color:#1abc9c; border: indigo 5px solid;">
        <h1 align="center" style="color:white;">SERVICIOS</h1>
        <hr>
        <h3 v-if="listaServicio.length === 0">No Hay servicios disponibles</h3>
    <h3 v-else></h3>
    <div>
    <div class="card-columns">
    <div class="card" v-for="(servicio, index) in listaServicio" :key="servicio.id" v-bind:class="[index + 1 % 2 == 0 ? 'p-3':'' ]">

       <div v-if="servicio.id==1">
                  
         <a href="/solicitudPartidaRegistro">  <img class="card-img-top" src="img/registro.png" width="50" height="150" alt="alcaldia logo"></a>
    
         </div>
           <div v-else>
       <div v-if="servicio.id==2 ||servicio.id==3">
           <div v-if="servicio.id==2">
      <a href="/transparencia">   <img class="card-img-top" src="img/transparencia.JPG" width="50" height="150" alt="transparencia  logo"></a>
       
           </div>
           <div v-else>
                <a href="/solicitudDocumentoRegistro">   <img class="card-img-top" src="img/transparencia.JPG" width="50" height="150" alt="transparencia logo"></a>
                </div>
       
       </div>

       <div v-else>
       
       <img class="card-img-top" src="img/logo.jpg" width="50" height="150" alt="alcaldia logo">

         </div>

       



        
       

         </div>
       
       
       
       
       
        <div class="card-title">
            <h3  class="card-title" align="center" v-text="servicio.nombre"></h3>
        </div>
        <div class="card-body">
              <textarea type="text" v-text="servicio.descripcion" class="form-control"  cols="10" rows="10" disabled ></textarea>
        </div>
    </div>
    </div>
    </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            listaServicio: [],
            nombre: "",
            descripcion: "",
            id: 0
        }
    },
    methods: {
        listarServicios(){
           // let me = this;
            axios.get("/get-servicios").then( (respuesta) =>{
                    this.listaServicio = respuesta.data;
            }).catch( (error) => console.log(error));
        },
        
      
    }, 
    mounted() {
        this.listarServicios();
    }
}
</script>
