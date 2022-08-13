<?php

use App\Http\Controllers\FotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InspeccionController;
use App\Http\Controllers\PropuestaController;
use App\Mail\InspeccionRealizada;
use Illuminate\Support\Facades\Mail;

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


/*Route::get('/email/', function () {

    Mail::to('andresrom@gmail.com')->send(new InspeccionRealizada());
    
    return new InspeccionRealizada();
});*/


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/propuesta/{propuesta}/inspeccion',[InspeccionController::class,'create'] );

Route::get('/fotos', [FotoController::class, 'index'])->name('fotos.index');
Route::get('/fotos/create/{inspeccion}', [FotoController::class, 'create'])->name('fotos.create');
Route::post('/inspecciones/{inspeccion}/fotos', [FotoController::class, 'store'])->name('fotos.store');

Route::get('/inspecciones/create/{propuesta}',[InspeccionController::class,'create'])->name('inspecciones.create');
Route::get('/inspecciones/mailcia/{propuesta}',[InspeccionController::class,'enviarMailCia'])->name('inspecciones.enviarMailCia');

Route::get('/inspecciones/{inspeccion}',[InspeccionController::class,'show'])->name('inspecciones.show'); 

Route::get('/propuestas/create',[PropuestaController::class,'create'])->name('propuestas.create');
Route::post('/propuestas',[PropuestaController::class,'store'])->name('propuestas.store');
Route::get('/propuestas/{propuesta}/edit',[PropuestaController::class,'edit'])->name('propuestas.edit');
Route::patch('/propuestas/{propuesta}',[PropuestaController::class,'update'])->name('propuestas.update');
