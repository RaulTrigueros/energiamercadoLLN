const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
.styles([
    'node_modules/sweetalert2/dist/sweetalert2.min.css',
    "node_modules/font-awesome/css/font-awesome.min.css",
], 'public/css/general.css')
.styles([
    'resources/assets/plantilla/css/portal.min.css',
], 'public/css/portal/portal.css')    
.styles([
    "node_modules/@coreui/icons/css/coreui-icons.min.css",
    "node_modules/flag-icon-css/css/flag-icon.min.css",
    "node_modules/simple-line-icons/css/simple-line-icons.css",
    'resources/assets/plantilla/css/style.min.css',
    'resources/assets/plantilla/css/pace.min.css',

], 'public/css/dashboard/dashboard.css')
.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    "node_modules/sweetalert2/dist/sweetalert2.min.js",
], 'public/js/general.js')
.scripts([
    "node_modules/jquery/dist/jquery.min.js",
    "node_modules/popper.js/dist/umd/popper.min.js",
    "node_modules/bootstrap/dist/js/bootstrap.min.js",
   'resources/assets/plantilla/js/portal.js',
], 'public/js/portal/portal.js')
.scripts([
    "node_modules/jquery/dist/jquery.min.js",
    "node_modules/popper.js/dist/umd/popper.min.js",
    "node_modules/bootstrap/dist/js/bootstrap.min.js",
    "node_modules/pace-progress/pace.min.js",
    "node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js",
    "node_modules/@coreui/coreui-pro/dist/js/coreui.min.js",
    "node_modules/chart.js/dist/Chart.min.js",
    "node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js",
    'resources/assets/plantilla/js/dashboard.js',
], "public/js/dashboard/dashboard.js")
.js(['resources/assets/js/app.js'],'public/js/app.js');
