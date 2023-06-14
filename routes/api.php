<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AccuracyController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\PostMotelController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\PayMentController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PostController;
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
Route::controller(UserController::class)->group(function(){
    Route::get('/home-user','index');
    Route::post('login','login');
    Route::post('sigup','sigup');
    Route::post('sigin','sigin'); 
});
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user',function (Request $request){
        return [
            $request->user()
        ];
    }); 
    
    Route::post('logout', 'App\Http\Controllers\API\AuthController@logout');   
    Route::get('home', 'App\Http\Controllers\API\EventController@index');
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('/showcategory','show');
    Route::get('/category','index');
    Route::post('/category/create','create');
    Route::get('/category/list/','list');
    Route::delete('/category/delete/{id}','delete');
    Route::put('/category/edit/{id}','update');
});
Route::controller(LocationController::class)->group(function(){
    Route::get('/showLocation','show');
    Route::get('/location','index');
    Route::post('/location/create','create');
    Route::get('/location/list/','list');
    Route::delete('/location/delete/{id}','delete');
    Route::put('/location/edit/{id}','update');
});
Route::controller(AccuracyController::class)->group(function(){
    Route::get('/accuracy','index');
    Route::post('/accuracy/create','add');
    Route::get('/accuracy/list/','list');
    Route::delete('/accuracy/delete/{id}','delete');
    Route::put('/accuracy/edit/{id}','update');
});
Route::controller(CommentController::class)->group(function(){
    Route::get('/comment','index');
    Route::post('/comment/create','add');
    Route::get('/comment/list/','list');
    Route::delete('/comment/delete/{id}','delete');
    Route::put('/comment/edit/{id}','update');
});

Route::controller(NewsController::class)->group(function(){
    Route::get('news','index');
    Route::get('latestNews','showNews');
    Route::get('news/detail/{id}','showNewID');
    Route::post('news/create','create');
    Route::get('news/edit/{id}','edit');
    Route::delete('/news/delete/{id}','delete');
    Route::post('news/update/{id}','update');   
});
Route::controller(PostController::class)->group(function(){
    Route::get('post','index');
    Route::post('post/create','create');
    Route::get('/comment/byID','showByID');
    Route::delete('/post/delete/{id}','delete'); 
});
Route::controller(MemberController::class)->group(function(){
    Route::get('member','index');
    Route::post('member/create','create');
    Route::get('member/edit/{id}','edit');
    Route::delete('member/delete/{id}','delete');
    Route::post('member/update/{id}','update');
    Route::post('member/login','login');
});
Route::controller(ContactController::class)->group(function(){
    Route::get('/contact','index');
    Route::post('contact/create','create');
    Route::delete('contact/delete/{id}','delete');
});
Route::controller(PostMotelController::class)->group(function(){
    Route::get('/home','show');
    Route::get('/search','search');
    Route::get('/productPostMotel/{id}','showByID');
    Route::get('/searchPostMotelByCategoryID/{id}','showCategoryID');
    Route::get('/searchPostMotelByLocationID/{id}','showLocationID');
    Route::get('postmotel','index');
    Route::post('postmotel/create','create');
    Route::delete('postmotel/delete/{id}','delete');
    Route::post('postmotel/update/{id}','update');  
    Route::post('postmotel/updateSee/{id}','updateSee');  
});
Route::controller(LikeController::class)->group(function(){
    Route::get('like','index');
    Route::post('like/create','create');
    Route::delete('like/delete/{id}','delete');
});
Route::controller(PayMentController::class)->group(function(){
    Route::post('pay','pay');
});
Route::controller(AccuracyController::class)->group(function(){
    Route::get('/accuracy','index');
    Route::post('/accuracy/create','add');
    Route::get('/accuracy/list/','list');
    Route::delete('/accuracy/delete/{id}','delete');
    Route::put('/accuracy/edit/{id}','update');
});