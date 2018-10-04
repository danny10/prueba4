<?php

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

//usuario invitado
Route::group(['middleware'=>['guest']],function(){
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');   
});

//usuario logueado
Route::group(['middleware'=>['auth']],function(){

    Route::post('/logout', 'Auth\LoginController@Logout')->name('logout');
   
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware'=>['Administrador']],function(){

        Route::get('/empresa', 'EmpresaController@index');
        Route::get('/empresa/selectEmpresa', 'EmpresaController@selectEmpresa');
        Route::post('/empresa/registrar', 'EmpresaController@store');
        Route::put('/empresa/actualizar', 'EmpresaController@update');
        Route::put('/empresa/desactivar', 'EmpresaController@desactivar');
        Route::put('/empresa/activar', 'EmpresaController@activar');

        Route::get('/empleado', 'EmpleadoController@index');
        Route::post('/empleado/registrar', 'EmpleadoController@store');
        Route::put('/empleado/actualizar', 'EmpleadoController@update');
        Route::put('/empleado/desactivar', 'EmpleadoController@desactivar');
        Route::get('/empleado/listarEmpleados', 'EmpleadoController@listarEmpleados');
    
    });
});

Route::get('/home', 'HomeController@index')->name('home');


