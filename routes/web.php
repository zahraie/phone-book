<?php

use App\Http\Controllers\TodoController ;
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
Route::get('/welcome' , function(){
    return view('welcome');
});

Route::get('/home' , function(){
    return view('home');
});

Route::prefix('todos')->group(function(){
    Route::get('/' , [TodoController::class , 'index'])->name('todos.index');
    Route::get('/create' , [TodoController::class , 'create'])->name('todos.create');
    Route::post('/store' , [TodoController::class , 'store'])->name('todos.store');
    Route::get('/{todo}' , [TodoController::class , 'show'])->name('todos.show');
    Route::get('/{todo}/edit' , [TodoController::class , 'edit'])->name('todos.edit');
    Route::put('/{todo}' , [TodoController::class , 'update'])->name('todos.update');
    Route::delete('/{todo}' , [TodoController::class , 'delete'])->name('todos.delete');
    Route::get('/{todo}/complete' , [TodoController::class , 'complete'])->name('todos.complete');
});


