<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\InitController;
use App\Http\Controllers\CursoController;

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
    return view('welcome');
});
//Recetas
Route:: get('/cursos',[InitController::class, "index"])->name("init.index");
Route:: get('/cursosI',[CursoController::class, "index"])->name("cursos.index");
Route::get('/cursos/create', [CursoController::class, "create"])->name("cursos.create");
Route::post('/cursos', [CursoController::class, "store"])->name("cursos.store");
Route::get('/cursos/{curso}', [CursoController::class, "show"])->name("cursos.show");
Route::get('/cursos/{curso}/edit', [CursoController::class, "edit"])->name("cursos.edit");
Route::put('/cursos/{curso}', [CursoController::class, "update"])->name("cursos.update");
Route::delete('/cursos/{curso}', [CursoController::class, "destroy"])->name("cursos.destroy");

//LLamar rutas resources controller
//Route::resource('recetas',CursoController::class);

//Perfiles
Route::get('/perfiles/{perfil}', [PerfilController::class, "show"])->name("perfiles.show");
Route::get('/perfiles/{perfil}/edit', [PerfilController::class, "edit"])->name("perfiles.edit");
Route::put('/perfiles/{perfil}', [PerfilController::class, "update"])->name("perfiles.update");

//Likes Recetas 
Route::post('/cursos/{curso}', [LikeController::class, "update"])->name("likes.update");

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
