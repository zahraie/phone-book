<?php


use App\Http\Controllers\Api\NoteApiController;
use App\Http\Controllers\Api\TodoApiController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//dd(NoteApiController::class);

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [ApiController::class, 'authenticate']);
    Route::post('register', [ApiController::class, 'register']);
    Route::post('logout', [ApiController::class, 'logout']);
});

Route::get('user', [ApiController::class, 'get_user'])->middleware('jwt.verify');


Route::group(['prefix' => 'note', 'middleware' => 'jwt.verify'], function () {
    Route::get('/' , [NoteApiController::class, 'getAll']);
    Route::post('/add' , [NoteApiController::class, 'add']);
    Route::put('/{id}' , [NoteApiController::class, 'update']);
    Route::delete('/{id}' , [NoteApiController::class, 'delete']);
    });//->middleware('jwt.verify');

Route::group(['prefix' => 'todo'], function () {
    Route::post('/xx' ,function () {
        return 'dddd';
    });

    Route::post('/' , [TodoApiController::class , 'index']);
    Route::get('/create' , [TodoApiController::class , 'create']);
    Route::get('/{todo}' , [TodoApiController::class , 'show']);
    Route::get('/{todo}/edit' , [TodoApiController::class , 'edit']);
    Route::put('/{todo}' , [TodoApiController::class , 'update']);
    Route::delete('/{todo}' , [TodoApiController::class , 'delete']);
    Route::get('/{todo}/complete' , [TodoApiController::class , 'complete']);
});
