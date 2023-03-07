<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/register', RegisterController::class);
Route::apiResource('/login', LoginController::class);

Route::controller(CategoryController::class)->group(function () {
   Route::prefix('/categories')->group(function () {
      Route::get('/', 'index');
      Route::get('/{category}/{slug?}', 'show');
   });
   
   Route::prefix('/blog')->group(function (){
      Route::prefix('/categories')->group(function () {
         Route::get('/', 'index');
         Route::get('/{category}/{slug?}', 'show');
      });      
   });
});

Route::controller(PostController::class)->group(function () {
   Route::prefix('/blog/posts')->group(function () {
      Route::get('/', 'index');
      Route::get('/{post}/{slug?}', 'show');
   });
});
  
Route::middleware('auth:sanctum')->group(function(){
   Route::post('/logout', [LoginController::class, 'logout']);

   Route::middleware('can:isAdmin')->group(function(){

      Route::controller(CategoryController::class)->group(function () {
         Route::prefix('/categories')->group(function () {
            Route::post('/', 'store');
            Route::patch('/{category}', 'update');
            Route::delete('/{category}', 'destroy');
         });
      });

      Route::controller(PostController::class)->group(function () {
         Route::prefix('/blog/posts')->group(function () {
            Route::post('/', 'store');
            Route::patch('/{post}', 'update');
            Route::delete('/{post}', 'destroy'); 
         });
      });

       
   
   });


    
});


Route::get('/user',function(){
   return response()->json(auth('sanctum')->user()->role);
 });