
import DateFilter from './filtros/date'

require('./bootstrap');

// Cargar Axios y configurarlo
window.axios = require('axios');

// Asegurar que se envía el encabezado CSRF
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token no encontrado. Asegúrate de tener <meta name="csrf-token" content="{{ csrf_token() }}"> en tu layout.');
}
/* Termina la carga de axios */


window.Vue = require('vue');

import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
Vue.use(VueFormWizard)


Vue.component('combustible', require('./components/Combustible.vue').default);
Vue.component('energia', require('./components/Energia.vue').default);
Vue.component('cliente', require('./components/Cliente.vue').default);
Vue.component('puesto', require('./components/Puesto.vue').default);
//Vue.component('inscripcion', require('./components/Inscripcion.vue').default);


Vue.component('rol', require('./components/Rol.vue').default);
// Vue.component('test', require('./components/Test.vue').default);
Vue.component('usuario', require('./components/User.vue').default);

//**** Componentes vue para Bitacora ****
Vue.component('bitacora', require('./components/Bitacora.vue').default);

Vue.filter('fecha', DateFilter);
Vue.component('dropdown', require('./components/dropdown.vue').default);

//**** Componentes vue para menu 26 ****
Vue.component('menu26', require('./components/menu26.vue').default);
//***************************************


const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
        idProyecto: 0
    }
});
export default app;
