<template>
    <div>
        <h1 @click="clicTitulo()">Este es el menu 26</h1>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            contador: 0,
        }
    },
    methods: {
        clicTitulo(){
            console.log(`numero de clics: ${++this.contador}`);
            axios.get("/sumar5/"+this.contador)
            .then( respuesta => {
                console.log(`la respuesta del servidor luego de sumar es: ${respuesta.data}`);
                
            })
            .catch((error) => console.log('ha ocurrido un error: ',error));
        }
    },
    mounted() {
        
    },
}
</script>