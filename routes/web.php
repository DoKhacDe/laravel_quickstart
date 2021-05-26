<?php
use App\Http\Controllers\MainController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/auth/save',[MainController::class, 'save'])->name('auth.save');
Route::post('/auth/check',[MainController::class, 'check'])->name('auth.check');
Route::get('/auth/logout',[MainController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => ['autoCheck']], function(){
    Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');
    Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
    Route::get('/todolist/index', [MainController::class, 'index']);
    Route::get('/todolist/create', [MainController::class, 'create']);
    Route::post('/todolist/upload', [MainController::class, 'upload']);
    Route::post('/todolist/update', [MainController::class, 'update']);
    Route::get('{id}/todolist/completed', [MainController::class, 'completed']);
    Route::get('{id}/todolist/edit', [MainController::class, 'edit']);
    Route::get('{id}/todolist/delete', [MainController::class, 'delete']);
});