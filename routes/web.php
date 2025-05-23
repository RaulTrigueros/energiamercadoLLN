<?php

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;


//GRUPO DE RUTAS
Route::get('/', function () {
    if (Auth::user()) {
        return view('contenido/index', ['log' => 'si']);
    } else {
        return view('contenido/index', ['log' => 'no']);
    }
});

Route::get('/', 'Auth\LoginController@showLoginForm');
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
Route::group(['middleware' => ['Administrador']], function () {

    Route::get('/main', function () {
        if (Auth::user()) {
            return view('contenido/contenido', ['rol' => Auth::user()->role_id, 'user' => Auth::user()]);
        } else {
            return redirect("/");
        }
    })->name('main'); //muestra el contenido principal de la aplicacion

    Route::get('/portal', function () {
        if (Auth::user()) {
            return view('contenido/index', ['log' => 'si']);
        } else {
            return view('contenido/index', ['log' => 'no']);
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
    Route::get('/tipocombustible/selectTipocombustible', 'TipocombustibleController@selectTipocombustible');
    Route::get('/combustible', 'CombustibleController@index');
    Route::post('/combustible/registrar', 'CombustibleController@store');
    Route::put('/combustible/actualizar', 'CombustibleController@update');
    Route::put('/combustible/desactivar', 'CombustibleController@desactivar');
    Route::put('/combustible/activar', 'CombustibleController@activar');
    Route::put('/combustible/eliminar', 'CombustibleController@destroy');
    Route::get('/combustible/generarReporteCombustible', 'CombustibleController@generarReporteCombustible')->name('combustibles_pdf');
    Route::get('/combustible/generarReportePrograms2', 'CombustibleController@generarReportePrograms2')->name('combustibles_pdf');
    Route::get('/combustible/pdf/{id}', 'CombustibleController@inscripcionPDF')->name('inscripciones_pdf');
    Route::get('/combustible/pdf/fecha/{inicio}/{fin}/{equipo}', 'CombustibleController@filtrofecha')->name('combustibles_pdf');
    Route::get('/combustible/pdf/fecha/{inicio}/{fin}', 'CombustibleController@filtrofechamensual')->name('combustibles_pdfmensual');
    Route::get('/combustible/pdf/equipo/{equipo}', 'CombustibleController@filtroequipo')->name('combustibles_pdf');
    //MODULO DE CONSUMO DE ENERGÍA ELÉCTRICA
    Route::get('/cliente', 'ClienteController@index');
    Route::post('/cliente/registrar', 'ClienteController@store');
    Route::put('/cliente/actualizar', 'ClienteController@update');
    Route::put('/cliente/eliminar', 'ClienteController@destroy');
    Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

    Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
    Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');

    //MÓDULO DE CONSUMO DE ENERGÍA
    Route::get('/persona/selectPersona', 'ClienteController@selectCliente');
    Route::get('/energia', 'EnergiaController@index');
    Route::post('/energia/registrar', 'EnergiaController@store');
    Route::put('/energia/actualizar', 'EnergiaController@update');
    Route::put('/energia/desactivar', 'EnergiaController@desactivarFactura');
    Route::put('/energia/activar', 'EnergiaController@activarFactura');
    Route::put('/energia/eliminar', 'EnergiaController@destroy');
    Route::get('/energia/generarReporteEnergia', 'EnergiaController@generarReporteEnergia')->name('energia_pdf');
    Route::get('/energia/pdfFactura/{id}', 'EnergiaController@facturaPDF')->name('facturas_pdf');
    Route::get('/energia/pdf/nopagado', 'EnergiaController@filtropago')->name('energia_pdf');
    Route::get('/energia/pdf/fecha/{inicio}/{fin}', 'EnergiaController@filtrofechamensual')->name('energia_pdfmensual');
    Route::get('/energia/pdf/puesto/{puesto}', 'EnergiaController@filtropuesto')->name('energia_pdf');

    //MÓDULO DE GESTION DE PUESTOS
    Route::get('/puesto/selectPuesto', 'PuestoController@selectPuesto');
    Route::get('/puesto', 'PuestoController@index');
    Route::post('/puesto/registrar', 'PuestoController@store');
    Route::put('/puesto/actualizar', 'PuestoController@update');
    Route::put('/puesto/eliminar', 'PuestoController@destroy');
    //  Route::put('/puesto/desactivar','PuestoController@desactivarFactura');
    // Route::put('/puesto/activar','PuestoController@activarFactura');*/

    //inscripcion talleres y competencias
    Route::get('/talleres', function () {
        if (Auth::user()) {
            return view('contenido/talleres', ['log' => 'si']);
        } else {
            return view('contenido/talleres', ['log' => 'no']);
        }
    });
    Route::get('/competencias', function () {
        if (Auth::user()) {
            return view('contenido/competencias', ['log' => 'si']);
        } else {
            return view('contenido/competencias', ['log' => 'no']);
        }
    });
    Route::get('/get-talleres', 'EnergiaController@getTalleresActivos');
    Route::get('/get-competencias', 'EnergiaController@getCompetenciasActivas');
    Route::post('/inscribir', 'InscripcionController@store');
});

//GRUPO DE RUTAS PARA COMBUSTIBLES
Route::group(['middleware' => ['Combustible']], function () {
    Route::get('/main', function () {
        if (Auth::user()) {
            return view('contenido/contenido', ['rol' => Auth::user()->role_id, 'user' => Auth::user()]);
        } else {
            return redirect("/");
        }
    })->name('main'); //muestra el contenido principal de la aplicacion

    Route::get('/portal', function () {
        if (Auth::user()) {
            return view('contenido/index', ['log' => 'si']);
        } else {
            return view('contenido/index', ['log' => 'no']);
        }
    });

    Route::get('/tipocombustible/selectTipocombustible', 'TipocombustibleController@selectTipocombustible');
    Route::get('/combustible', 'CombustibleController@index');
    Route::post('/combustible/registrar', 'CombustibleController@store');
    Route::put('/combustible/actualizar', 'CombustibleController@update');
    Route::put('/combustible/desactivar', 'CombustibleController@desactivar');
    Route::put('/combustible/activar', 'CombustibleController@activar');
    Route::put('/combustible/eliminar', 'CombustibleController@destroy');
    Route::get('/combustible/generarReporteCombustible', 'CombustibleController@generarReporteCombustible')->name('combustibles_pdf');
    Route::get('/combustible/generarReportePrograms2', 'CombustibleController@generarReportePrograms2')->name('combustibles_pdf');
    Route::get('/combustible/pdf/{id}', 'CombustibleController@inscripcionPDF')->name('inscripciones_pdf');
    Route::get('/combustible/pdf/fecha/{inicio}/{fin}/{equipo}', 'CombustibleController@filtrofecha')->name('combustibles_pdf');
    Route::get('/combustible/pdf/fecha/{inicio}/{fin}', 'CombustibleController@filtrofechamensual')->name('combustibles_pdfmensual');
    Route::get('/combustible/pdf/equipo/{equipo}', 'CombustibleController@filtroequipo')->name('combustibles_pdf');
    //inscripcion talleres y competencias
    Route::get('/talleres', function () {
        if (Auth::user()) {
            return view('contenido/talleres', ['log' => 'si']);
        } else {
            return view('contenido/talleres', ['log' => 'no']);
        }
    });
    Route::get('/competencias', function () {
        if (Auth::user()) {
            return view('contenido/competencias', ['log' => 'si']);
        } else {
            return view('contenido/competencias', ['log' => 'no']);
        }
    });
    Route::get('/get-talleres', 'CombustibleController@getTalleresActivos');
    Route::get('/get-competencias', 'CombustibleController@getCompetenciasActivas');
    Route::post('/inscribir', 'InscripcionController@store');
});
