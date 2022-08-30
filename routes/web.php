<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\MainController;
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
	return view('auth.login');
});

Auth::routes();

Route::get('/home', [MainController::class, 'index'])->name('main'); 

/*rutas para el perfil*/
Route::get('/editar-perfil',[PerfilController::class, 'index'])->name('profile.index');

Route::post('/editar-perfil',[PerfilController::class, 'store'])->name('profile.store');

/*ruta para  las imagenes por dropzone*/
Route::post('/imagenes', [ImageController::class, 'store'])->name('image.store');


/*ventana principal cuando entras*/
Route::get('{user:name}', [HomeController::class, 'index'])->name('home');

/*post*/
Route::get('/posts/create', [PostController::class, 'index'])->name('post.index');
Route::post('/post', [PostController::class, 'store'])->name('post.store');

Route::get('{user:name}/post/{post}/',[PostController::class, 'show'])->name('post.show');

Route::post('{user:name}/post/{post}/',[CommentController::class, 'store'])->name('comment.store');

Route::delete('post/{id}',[PostController::class,'destroy'])->name('post.destroy');



/*ruta para los likes*/
Route::post('posts/{post}/likes',[LikeController::class,'store'])->name('like.store');
Route::delete('posts/{post}/likes',[LikeController::class,'destroy'])->name('like.destroy');


/*followeres*/
Route::post('{user:name}/follow', [FollowerController::class, 'store'])->name('users.follow');

Route::delete('{user:name}/unfollow', [FollowerController::class, 'destroy'])->name('follow.destroy');