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

 Route::get('/', function () {
    $doctors=   DB::table('doctors')->orderBy('status', 'asc')->get();
     return view('accueil')->with(['doctors'=>$doctors]);
 });
 Route::get('/mapview', function () {
    return view('mapview');
});
Route::get('/doctors', function () {
    return view('doctor','DoctorController@index');
});
Route::get('/emer','emergencyLocation@saveLocation');
Route::get('/newuser','newuser@saveUser');
//Route::get('/','DoctorController@index');