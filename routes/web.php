<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('home');
Route::get('/add', function () {
    return view('add');
})->name('add');

Route::get('/home', [App\Http\Controllers\ArticleController::class, 'index']);
Route::get('/myArticle', [App\Http\Controllers\ArticleController::class, 'show'])->name('show');
Route::post('/add_process', [App\Http\Controllers\ArticleController::class, 'create']);
Route::get('/detail/{id}', [App\Http\Controllers\ArticleController::class, 'detail'])->name('detail');
Route::get('/delete/{id}', [App\Http\Controllers\ArticleController::class, 'delete']);
Route::post('/comment',[App\Http\Controllers\CommentController::class, 'create'])->name('store');
Route::get('/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('edit');
Route::put('/edit/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('update');
Route::get('/comment/edit/{id}', [App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit');
Route::put('/comment/update/{id}', [App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');



