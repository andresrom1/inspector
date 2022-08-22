<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InspeccionController;
use App\Http\Controllers\PropuestaController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\UserCreateController;
use App\Http\Controllers\SearchController;

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

//Auth::routes();

if(Auth::user()){
    Auth::routes();
}else{
    Auth::routes(['register' => false]);
}

Route::get('/fotos/create/{inspeccion}', [FotoController::class, 'create'])->name('fotos.create');
Route::post('/inspecciones/{inspeccion}/fotos', [FotoController::class, 'store'])->name('fotos.store');


Route::middleware(['usuario.registrado'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('home/search', [HomeController::class, 'indexSearch'])->name('indexSearch');

    Route::post('/propuesta/{propuesta}/inspeccion',[InspeccionController::class,'create'] );

    Route::get('/fotos', [FotoController::class, 'index'])->name('fotos.index');

    Route::delete('/fotos/{foto}', [FotoController::class,'destroy'])->name('fotos.destroy');

    Route::get('/inspecciones/create/{propuesta}',[InspeccionController::class,'create'])->name('inspecciones.create');
    Route::get('/inspecciones/mailcia/{propuesta}',[InspeccionController::class,'enviarMailCia'])->name('inspecciones.enviarMailCia');

    Route::get('/inspecciones/{inspeccion}',[InspeccionController::class,'show'])->name('inspecciones.show'); 

    Route::get('/propuestas/create',[PropuestaController::class,'create'])->name('propuestas.create');
    Route::post('/propuestas',[PropuestaController::class,'store'])->name('propuestas.store');
    Route::get('/propuestas/{propuesta}/edit',[PropuestaController::class,'edit'])->name('propuestas.edit');
    Route::patch('/propuestas/{propuesta}',[PropuestaController::class,'update'])->name('propuestas.update');
    Route::delete('/propuestas/{propuesta}',[PropuestaController::class,'destroy'])->name('propuestas.destroy');
    
    Route::get('search/propuestas',[SearchController::class,'autocomplete'])->name('propuestas.autocomplete');
    Route::post('search/busqueda',[SearchController::class,'search'])->name('propuestas.search');

    Route::get('/usuarios',[UserCreateController::class,'index'])->name('usuarios.create');
    Route::get('/usuarios/create',[UserCreateController::class,'create'])->name('usuarios.create');
    Route::post('/usuarios',[UserCreateController::class,'store'])->name('usuarios.store');
    Route::post('/usuarios/{usuario}',[UserCreateController::class,'destroy'])->name('usuarios.destroy');
    
});



