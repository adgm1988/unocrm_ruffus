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



Route::get('/demo',function(){
	return view('pages/demo');
});


Route::get('','DashboardController@index')->middleware('auth');
Route::get('dashboard','DashboardController@index');

Route::get('calendar','CalendarController@index');

Route::get('prospectos','ProspectoController@index');
Route::post('prospectos','ProspectoController@store');
Route::get('prospectos/{id}','ProspectoController@show');
Route::get('prospectos/delete/{id}','ProspectoController@destroy');

Route::get('prospectos/{id}/form','ProspectoController@form');
Route::post('prospectos/{id}','ProspectoController@update');

Route::get('prospectos/actividades/delete/{id}','ProspectoController@destroyact');
Route::post('prospecto/{id}/actividad','ActividadController@storeprosp');




Route::get('actividades','ActividadController@index');
Route::post('actividades','ActividadController@store');
Route::post('actividadescal','ActividadController@storecal');
Route::get('actividades/delete/{actividad}','ActividadController@destroy');

Auth::routes();

//rutas catalogos
Route::get('/users','UsersController@index');

Route::get('/etapas','EtapaController@index');
Route::post('/etapas','EtapaController@store');
Route::get('etapas/delete/{id}','EtapaController@destroy');

Route::get('/tipoacts','TipoactController@index');
Route::post('/tipoact','TipoactController@store');
Route::get('tipos/delete/{id}','TipoactController@destroy');

Route::get('/procedencias','ProcedenciaController@index');
Route::post('/procedencia','ProcedenciaController@store');
Route::get('procedencias/delete/{id}','ProcedenciaController@destroy');

Route::get('/industrias','IndustryController@index');
Route::post('/industria','IndustryController@store');
Route::get('industrias/delete/{id}','IndustryController@destroy');


Route::get('etapas/{id}/form','EtapaController@form');
Route::post('etapas/{id}','EtapaController@update');

Route::get('tipoacts/{id}/form','TipoactController@form');
Route::post('tipoacts/{id}','TipoactController@update');

Route::get('procedencias/{id}/form','ProcedenciaController@form');
Route::post('procedencias/{id}','ProcedenciaController@update');

Route::get('actividad/{id}/form','ActividadController@form');
Route::post('actividad/{id}','ActividadController@update');

Route::get('industria/{id}/form','IndustryController@form');
Route::post('industria/{id}','IndustryController@update');


Route::get('/home', 'HomeController@index')->name('home');
