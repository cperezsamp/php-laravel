<?php

//importamos el controller de persona
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthenticatedSessionController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActoController;
use App\Http\Controllers\PonenteController;
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

Route::view('/login', 'login') ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('log');
Route::get('/usuario', [ActoController::class, 'index']) ->name('usuario')->middleware('auth');
Route::get('/registro', [UsuarioController::class, 'create']) ->name('usuario.create');
Route::post('/registro', [UsuarioController::class, 'store']) ->name('usuario.crea');
Route::get('/inscBorr', [ActoController::class, 'inscribirseBorrarse']) ->name('inscribirseBorrarse');
Route::get('/verEvento', [ActoController::class, 'mostrarEvento']) ->name('verEvento');
Route::get('/profile', [UsuarioController::class, 'edit']) ->name('usuario.update')->middleware('auth');
Route::post('/profile', [UsuarioController::class, 'update'])->name('usuario.upd')->middleware('auth');
Route::get('/logout', [AuthenticatedSessionController::class, 'logout']) ->name('logout')->middleware('auth');

Route::get('/admin', [ActoController::class, 'admin']) ->name('admin');
Route::get('/crearacto', [ActoController::class, 'create']) ->name('crearacto');
Route::post('/crearacto', [ActoController::class, 'store']) ->name('crearacto');
Route::get('/editaracto', [ActoController::class, 'edit']) ->name('editaracto');
Route::post('/editaracto', [ActoController::class, 'editarActo']) ->name('editaracto');
Route::get('/inscritos', [ActoController::class, 'inscritos']) ->name('inscritos');

//si recibe datos
//Route::get('/', [PersonaController::class ,'index'])->name('index');

Route::view('/', 'auth')->name('autenticado')->middleware('auth');
//Route::view('/usuario', 'usuario')->name('usuario')->middleware('auth');
//Route::view('/ponente', 'ponente')->name('ponente')->middleware('auth');


Route::get('/ponente', [PonenteController::class, 'index'])->middleware('auth');
Route::post('/hanldeButton', [PonenteController::class, 'hanldeButton'])->middleware('ValidateRequest');
Route::post('/event_detail', [PonenteController::class, 'event_detail'])->middleware('ValidateRequest');
Route::post('/removeSpeaker', [PonenteController::class, 'removeSpeaker'])->middleware('ValidateRequest');
Route::get('/user-profile', [PonenteController::class, 'profile'])->middleware('ValidateRequest');
Route::post('/update_profile', [PonenteController::class, 'update_profile'])->middleware('ValidateRequest');


//si no recibe datos
Route::get('/welcome', function () {
    return 'welcome';
});
