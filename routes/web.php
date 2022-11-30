<?php

//importamos el controller de persona
use App\Http\Controllers\PersonaController; 
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

/*Route::get('/', function () {

    return view('index');
});*/

Route::view('/', 'login') ->name('login');
Route::get('/index', [PersonaController::class ,'index'])->name('index');


Route::get('/welcome', function () {
    return 'welcome';
});
