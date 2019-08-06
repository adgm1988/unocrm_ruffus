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

Route::get('/home', 'HomeController@index')->name('home');
