 /**
  * First we will load all of this project's JavaScript dependencies which
  * includes Vue and other libraries. It is a great starting point when
  * building robust, powerful web applications using Vue and Laravel.
  */
 import DateFilter from './filtros/date'

 require('./bootstrap');

 window.Vue = require('vue');

 import VueFormWizard from 'vue-form-wizard'
 import 'vue-form-wizard/dist/vue-form-wizard.min.css'
 Vue.use(VueFormWizard)
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */

 // const files = require.context('./', true, /\.vue$/i);
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

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

//***************************************
/*
 Vue.component('taller', require('./components/Taller.vue').default);
 Vue.component('competencia', require('./components/Competencia.vue').default);


 Vue.component('transparenciaPortal', require('./components/TransparenciaPortal.vue').default);
 Vue.component('transparenciaDashboard', require('./components/TransparenciaDashboard.vue').default);

 Vue.component('noticia', require('./components/Noticia.vue').default);
 Vue.component('noticiaportal', require('./components/NoticiaPortal.vue').default);

 Vue.component('anuncio', require('./components/Anuncio.vue').default);
 Vue.component('anuncioportal', require('./components/AnuncioPortal.vue').default);


 Vue.component('Solicitudpartidaregistro', require('./components/Solicitudpartidaregistro.vue').default);
 Vue.component('Solicituddocumentoregistro', require('./components/Solicituddocumentoregistro.vue').default);

 Vue.component('Solicituddocumento', require('./components/Solicituddocumento.vue').default);
 Vue.component('Solicitudpartida', require('./components/Solicitudpartida.vue').default);
 Vue.component('servicios', require('./components/Servicios.vue').default);

 //***** Componentes vue para gestión de PARTIDAS *****
 Vue.component('nacimiento', require('./components/nacimiento.vue').default);
 Vue.component('defuncion', require('./components/Defuncion.vue').default);
 Vue.component('matrimonio', require('./components/Matrimonio.vue').default);

 //***** Componentes vue para gestión de proyectos *****
 Vue.component('proyecto', require('./components/Proyecto.vue').default);
 Vue.component('encargado', require('./components/Encargado.vue').default);
 Vue.component('actividad', require('./components/Actividad.vue').default);
 //*******************************************

 Vue.component('matrimonio', require('./components/Matrimonio.vue').default);

//**** Componentes vue para manuales ****
Vue.component('manualesDash', require('./components/ManualesDash.vue').default);
Vue.component('manualesPortal', require('./components/ManualesPortal.vue').default);
//***************************************


 //**** Componentes vue para carrusel ****
 Vue.component('carruselDash', require('./components/CarruselDashboard.vue').default);
 Vue.component('carruselPortal', require('./components/CarruselPortal.vue').default);
 //***************************************


 //**** Componentes Contactos 
 Vue.component('contactosportal', require('./components/ContactosPortal.vue').default);
 Vue.component('contactos', require('./components/Contactos.vue').default);

 //**** Componentes Preguntas Frecuentes 
 Vue.component('preguntasportal', require('./components/PreguntasPortal.vue').default);
 Vue.component('preguntas', require('./components/Preguntas.vue').default);
 
 //**** Componentes de Organigramas 
 Vue.component('organigrama', require('./components/Organigrama.vue').default);
 Vue.component('organigramaportal', require('./components/OrganigramaPortal.vue').default);
*/
 const app = new Vue({
     el: '#app',
     data: {
         menu: 0,
         idProyecto: 0
     }
 });
 export default app;
