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
     $users =  DB::table('users')->where('status',1)->first();
    return view('mapview')->with(['users'=>$users]);
});

Route::get('/doctors', function () {
    return view('doctor','DoctorController@index');
});
Route::get('/userposi','emergencyLocation@saveLocation');
Route::get('/help','emergencyLocation@sendHelp');
Route::get('/newuser','newuser@saveUser');
Route::post('/ambuPosi','emergencyLocation@ambuPosi');
Route::post('/ambuPosiReq','emergencyLocation@ambuPosiReq');

//Route::get('/','DoctorController@index');