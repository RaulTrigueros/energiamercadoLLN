<?php

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//GRUPO DE RUTAS
Route::get('/', function () {
        if(Auth::user()){
            return view('contenido/index',['log'=>'si']);
        }else{
            return view('contenido/index',['log'=>'no']);
        }
});

Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login1', 'Auth\LoginController@login')->name('login');

    //mision y vision
Route::get('/mision', function () {
    return view('mision/misionvision');
});

    //Cambiar contraseña
Route::get('user/password', 'UserController@password');
Route::post('user/updatepassword', 'UserController@updatePassword');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


//GRUPO DE RUTAS PARA ADMINISTRADOR
Route::group(['middleware'=>['Administrador']],function(){
    
    Route::get('/main', function () {
        if(Auth::user()){
            return view('contenido/contenido',['rol'=>Auth::user()->role_id, 'user'=> Auth::user()]);
        }else{
            return redirect("/");
        }
    })->name('main'); //muestra el contenido principal de la aplicacion

    Route::get('/portal', function () {
        if(Auth::user()){
            return view('contenido/index',['log'=>'si']);
        }else{
            return view('contenido/index',['log'=>'no']);
        }
    });
    //********* BITACORA ***********
    Route::get('/bitacora', 'BitacoraController@index');
    //******************************
    Route::get('/registro', function () {
        return view('contenido/registroUser');
    });
    //MODULO DE GESTIÓN DE USUARIOS
    Route::get('/rol', 'RolController@index');
    Route::get('/rol/selectRol', 'RolController@selectRol');
    Route::get('/user', 'UserController@index');
    Route::post('/user/registrar', 'UserController@store');
    Route::put('/user/actualizar', 'UserController@update');
    Route::put('/user/desactivar', 'UserController@desactivar');
    Route::put('/user/activar', 'UserController@activar');
    //MÓDULO DE CONSUMO DE COMBUSTIBLE
    Route::get('/tipocombustible/selectTipocombustible','TipocombustibleController@selectTipocombustible');
    Route::get('/combustible','CombustibleController@index');
    Route::post('/combustible/registrar','CombustibleController@store');
    Route::put('/combustible/actualizar','CombustibleController@update');
    Route::put('/combustible/desactivar','CombustibleController@desactivar');
    Route::put('/combustible/activar','CombustibleController@activar');
    Route::put('/combustible/eliminar','CombustibleController@destroy');
    Route::get('/combustible/generarReporteCombustible','CombustibleController@generarReporteCombustible')->name('combustibles_pdf');
    Route::get('/combustible/generarReportePrograms2','CombustibleController@generarReportePrograms2')->name('combustibles_pdf');
    Route::get('/combustible/pdf/{id}','CombustibleController@inscripcionPDF')->name('inscripciones_pdf');
    Route::get('/combustible/pdf/fecha/{inicio}/{fin}/{equipo}','CombustibleController@filtrofecha')->name('combustibles_pdf');
    Route::get('/combustible/pdf/fecha/{inicio}/{fin}','CombustibleController@filtrofechamensual')->name('combustibles_pdfmensual');
    Route::get('/combustible/pdf/equipo/{equipo}','CombustibleController@filtroequipo')->name('combustibles_pdf');
    //MODULO DE CONSUMO DE ENERGÍA ELÉCTRICA
    Route::get('/cliente', 'ClienteController@index');
    Route::post('/cliente/registrar', 'ClienteController@store');
    Route::put('/cliente/actualizar', 'ClienteController@update');
    Route::put('/cliente/eliminar','ClienteController@destroy');
    Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

    Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
    Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');

    //MÓDULO DE CONSUMO DE ENERGÍA
    Route::get('/persona/selectPersona','ClienteController@selectCliente');
    Route::get('/energia','EnergiaController@index');
    Route::post('/energia/registrar','EnergiaController@store');
    Route::put('/energia/actualizar','EnergiaController@update');
    Route::put('/energia/desactivar','EnergiaController@desactivarFactura');
    Route::put('/energia/activar','EnergiaController@activarFactura');
    Route::put('/energia/eliminar','EnergiaController@destroy');
    Route::get('/energia/generarReporteEnergia','EnergiaController@generarReporteEnergia')->name('energia_pdf');
    Route::get('/energia/pdfFactura/{id}','EnergiaController@facturaPDF')->name('facturas_pdf');
    Route::get('/energia/pdf/nopagado','EnergiaController@filtropago')->name('energia_pdf');
    Route::get('/energia/pdf/fecha/{inicio}/{fin}','EnergiaController@filtrofechamensual')->name('energia_pdfmensual');
    Route::get('/energia/pdf/puesto/{puesto}','EnergiaController@filtropuesto')->name('energia_pdf');

     //MÓDULO DE GESTION DE PUESTOS
    Route::get('/puesto/selectPuesto','PuestoController@selectPuesto');
    Route::get('/puesto','PuestoController@index');
    Route::post('/puesto/registrar','PuestoController@store');
    Route::put('/puesto/actualizar','PuestoController@update');
    Route::put('/puesto/eliminar','PuestoController@destroy');
   //  Route::put('/puesto/desactivar','PuestoController@desactivarFactura');
    // Route::put('/puesto/activar','PuestoController@activarFactura');*/

    //inscripcion talleres y competencias
    Route::get('/talleres', function () {
        if(Auth::user()){
            return view('contenido/talleres',['log'=>'si']);
        }else{
            return view('contenido/talleres',['log'=>'no']);
        }
    });
    Route::get('/competencias', function () {
        if(Auth::user()){
            return view('contenido/competencias',['log'=>'si']);
        }else{
            return view('contenido/competencias',['log'=>'no']);
        }
    });
    Route::get('/get-talleres', 'EnergiaController@getTalleresActivos');
    Route::get('/get-competencias', 'EnergiaController@getCompetenciasActivas');
    Route::post('/inscribir', 'InscripcionController@store');

});

//GRUPO DE RUTAS PARA COMBUSTIBLES
Route::group(['middleware'=>['Combustible']],function(){
    Route::get('/main', function () {
            if(Auth::user()){
                return view('contenido/contenido',['rol'=>Auth::user()->role_id, 'user'=> Auth::user()]);
            }else{
                return redirect("/");
            }
    })->name('main'); //muestra el contenido principal de la aplicacion

    Route::get('/portal', function () {
            if(Auth::user()){
                return view('contenido/index',['log'=>'si']);
            }else{
                return view('contenido/index',['log'=>'no']);
            }
    });

    Route::get('/tipocombustible/selectTipocombustible','TipocombustibleController@selectTipocombustible');
    Route::get('/combustible','CombustibleController@index');
    Route::post('/combustible/registrar','CombustibleController@store');
    Route::put('/combustible/actualizar','CombustibleController@update');
    Route::put('/combustible/desactivar','CombustibleController@desactivar');
    Route::put('/combustible/activar','CombustibleController@activar');
    Route::put('/combustible/eliminar','CombustibleController@destroy');
    Route::get('/combustible/generarReporteCombustible','CombustibleController@generarReporteCombustible')->name('combustibles_pdf');
    Route::get('/combustible/generarReportePrograms2','CombustibleController@generarReportePrograms2')->name('combustibles_pdf');
    Route::get('/combustible/pdf/{id}','CombustibleController@inscripcionPDF')->name('inscripciones_pdf');
    Route::get('/combustible/pdf/fecha/{inicio}/{fin}/{equipo}','CombustibleController@filtrofecha')->name('combustibles_pdf');
    Route::get('/combustible/pdf/fecha/{inicio}/{fin}','CombustibleController@filtrofechamensual')->name('combustibles_pdfmensual');
    Route::get('/combustible/pdf/equipo/{equipo}','CombustibleController@filtroequipo')->name('combustibles_pdf');
    //inscripcion talleres y competencias
    Route::get('/talleres', function () {
        if(Auth::user()){
            return view('contenido/talleres',['log'=>'si']);
        }else{
            return view('contenido/talleres',['log'=>'no']);
        }
    });
    Route::get('/competencias', function () {
        if(Auth::user()){
            return view('contenido/competencias',['log'=>'si']);
        }else{
            return view('contenido/competencias',['log'=>'no']);
        }
    });
    Route::get('/get-talleres', 'CombustibleController@getTalleresActivos');
    Route::get('/get-competencias', 'CombustibleController@getCompetenciasActivas');
    Route::post('/inscribir', 'InscripcionController@store');
});

/* ***RUTAS SIN FUNCIONALIDAD

//Noticias
Route::get('/noticia','NoticiaController@index');
Route::post('/noticia/registrar','NoticiaController@store');
Route::put('/noticia/actualizar','NoticiaController@update');
Route::put('/noticia/desactivar','NoticiaController@desactivar');
Route::put('/noticia/activar','NoticiaController@activar');
Route::get('/get-noticias','NoticiaController@getNoticias');

Route::get('/noticiaportal', function () {
    if (Auth::user()) {
        return view('contenido/noticias', ['log' => 'si']);
    } else {
        return view('contenido/noticias', ['log' => 'no']);
    }
});


Route::get('/anuncio', 'AnuncioController@index');
Route::post('/anuncio/registrar', 'AnuncioController@registroAnuncio');
Route::put('/anuncio/actualizar', 'AnuncioController@update');
Route::put('/anuncio/activar', 'AnuncioController@activar');
Route::put('/anuncio/desactivar', 'AnuncioController@desactivar');
Route::get('/get-anuncios', 'AnuncioController@getAnunciosActivos');

Route::get('/tipodocumento/selectTipodocumento','TipodocumentoController@selectTipodocumento');

Route::get('/solicituddocumento','SolicituddocumentoController@index');
Route::post('/solicituddocumento/registrar','SolicituddocumentoController@store');
Route::put('/solicituddocumento/desactivar','SolicituddocumentoController@desactivar');
Route::put('/solicituddocumento/activar','SolicituddocumentoController@activar');

Route::get('/solicitudDocumentoRegistro', function () {
    if(Auth::user()){
        return view('contenido/solicituddocumentos',['log'=>'si']);
    }else{
        return view('contenido/solicituddocumentos',['log'=>'no']);
    }
});

Route::get('/solicitudpartida','SolicitudpartidaController@index');
Route::post('/solicitudpartida/registrar','SolicitudpartidaController@store');
Route::put('/solicitudpartida/desactivar','SolicitudpartidaController@desactivar');
Route::put('/solicitudpartida/activar','SolicitudpartidaController@activar');

Route::get('/solicitudPartidaRegistro', function () {
    if(Auth::user()){
        return view('contenido/solicitudpartidas',['log'=>'si']);
    }else{
        return view('contenido/solicitudpartidas',['log'=>'no']);
    }
});

//Transparencia
Route::get('/solicitudinsumo', function () {
    if (Auth::user()) {
        return view('contenido/transparencia', ['log' => 'si']);
    } else {
        return view('contenido/transparencia', ['log' => 'no']);
    }
});
//Anuncios
Route::get('/anuncioportal', function () {
    if(Auth::user()){
        return view('contenido/anuncios',['log'=>'si']);
    }else{
        return view('contenido/anuncios',['log'=>'no']);
    }
});

Route::post('/registrarDoc', 'TransparenciaController@store');
Route::get('/get-documentos', 'TransparenciaController@getDocumentos');
Route::post('/eliminarDoc', 'TransparenciaController@delete');
Route::post('/actualizarDoc', 'TransparenciaController@update');





//servicios

Route::get('/servicio', 'ServicioController@index');
Route::post('/servicio/registrar', 'ServicioController@registroServicio');
Route::put('/servicio/actualizar', 'ServicioController@update');
Route::put('/servicio/activar', 'ServicioController@activar');
Route::put('/servicio/desactivar', 'ServicioController@desactivar');
Route::get('/get-servicios', 'ServicioController@getServicios');

//nacimientos
Route::get('/nacimiento', 'PartidaController@index');
Route::post('/nacimiento/registrar', 'PartidaController@registroPartida');
Route::get('/nacimiento/pdf/{id}','PartidaController@nacimientoPDF')->name('partidas_pdf');
Route::put('/nacimiento/actualizar', 'PartidaController@update');
//partidas de defuncion
Route::get('/defuncion', 'DefuncionController@index');
Route::post('/defuncion/registrar', 'DefuncionController@registroDefuncion');
Route::put('/defuncion/actualizar', 'DefuncionController@update');
Route::get('/defuncion/pdf/{id}','DefuncionController@defuncionPDF')->name('defuncion_pdf');

//matrimonio
Route::get('/matrimonio', 'MatrimonioController@index');
Route::post('/matrimonio/registrar', 'MatrimonioController@store');
Route::put('/matrimonio/actualizar', 'MatrimonioController@update');
Route::get('/matrimonio/pdf/{id}','MatrimonioController@matrimonioPDF')->name('matrimonio_pdf');


Route::get('/servicioportal', function () {
    if(Auth::user()){
        return view('contenido/servicio',['log'=>'si']);
    }else{
        return view('contenido/servicio',['log'=>'no']);
    }
});

//******** Proyectos **********
Route::get('/proyecto','ProyectoController@index');
Route::get('/proyecto/{id}', 'ProyectoController@getProyecto');
Route::post('/proyecto/registrar','ProyectoController@store');
Route::put('/proyecto/actualizar','ProyectoController@update');
Route::get('/proyecto/finalizar/{idProyecto}', 'ProyectoController@finalizarProyecto');
Route::get('/proyecto/estatus/{idProyecto}', 'ProyectoController@getEstatusProyecto');

Route::get('/encargado','EncargadoController@index');
Route::get('/encargado/selectEncargado','EncargadoController@selectEncargado');
Route::post('/encargado/registrar', 'EncargadoController@store');
Route::put('/encargado/actualizar', 'EncargadoController@update');

Route::resource('actividad', 'ActividadController');
Route::get('/actividades/buscar', 'ActividadController@buscar');

Route::resource('tipo-estatus', 'TipoEstatusController');
//*****************************




//********* CARRUSEL ***********
Route::get('/carrusel/{id_carrusel}', 'CarruselController@getCarrusel');
Route::get('/carrusel/{id_carrusel}/imagenes', 'ImagenCarruselController@getImagenes');

Route::get('/imagen_carrusel/{id_imagen}', 'ImagenCarruselController@getImagen');
Route::post('/imagen_carrusel/{id_carrusel}', 'ImagenCarruselController@create');
Route::delete('/imagen_carrusel/{id_imagen}', 'ImagenCarruselController@delete');
Route::put('/imagen_carrusel/{id_imagen}', 'ImagenCarruselController@update');
Route::post('/imagen_carrusel/orden/{id_imagen}/{orden}', 'ImagenCarruselController@updateOrden');
Route::get('/imagen_carrusel/img/{nombre_img}', 'ImagenCarruselController@getImage');
//******************************

// Route::get('/sumar5/{numero}', 'ActividadController@sumar5');

//********* MANUAL ORGANIZACION ***********
Route::get('/manuales', function () {
    if (Auth::user()) {
        return view('contenido/manualesOrganizacion', ['log' => 'si']);
    } else {
        return view('contenido/manualesOrganizacion', ['log' => 'no']);
    }
});

Route::get('/manuales/', 'ManualOrganizacionController@manuales');
Route::get('/manual/{id}', 'ManualOrganizacionController@getManual');
Route::delete('/manuales/{id}', 'ManualOrganizacionController@deleteManual');
Route::put('/manuales/{id}', 'ManualOrganizacionController@updateManual');
Route::post('/manuales', 'ManualOrganizacionController@createManual');
Route::get('/manuales/buscar', 'ManualOrganizacionController@buscar');

//Contactos
Route::get('/contactos', function(){
    return view('contenido/contactos', ['log'=>'no']);
});
Route::get('/getcontactos', 'ContactoController@index');
Route::post('/contacto/registrar', 'ContactoController@store');
Route::put('/contacto/actualizar', 'ContactoController@update');
Route::put('/contacto/eliminar', 'ContactoController@destroy');

//Preguntas Frecuentes

Route::get('/preguntas', function(){
    return view('contenido/preguntas');
});

Route::get('/getpreguntas', 'PreguntaController@index');
Route::get('/getallpreguntas', 'PreguntaController@selectPregunta');
Route::post('/pregunta/registrar', 'PreguntaController@store');
Route::put('/pregunta/actualizar', 'PreguntaController@update');
Route::put('/pregunta/eliminar', 'PreguntaController@destroy');


// Organigramas

Route::get('/organigrama', 'OrganigramaController@index');
Route::post('/organigrama/registrar', 'OrganigramaController@registroOrganigrama');
Route::put('/organigrama/actualizar', 'OrganigramaController@update');
Route::put('/organigrama/activar', 'OrganigramaController@activar');
Route::put('/organigrama/desactivar', 'OrganigramaController@desactivar');
Route::get('/get-organigramas', 'OrganigramaController@getOrganigramasActivos');

Route::get('/organigramaportal', function () {
    if(Auth::user()){
        return view('contenido/organigramas',['log'=>'si']);
    }else{
        return view('contenido/organigramas',['log'=>'no']);
    }
});
********FIN DE RUTAS SIN FUNCIONALIDAD*/