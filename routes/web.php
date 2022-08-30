<?php

use App\Http\Controllers\BoshuCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BoshujohoController;
use App\Http\Controllers\CommunityController;

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

//学習コミュニティのルート
Route::resource('community', CommunityController::class);

//募集情報コメント保存用ルート
Route::post('boshujoho/boshucomment/store', [BoshuCommentController::class, 'store'])->name('boshucomment.store');

//boshujohoのリソースコントローラーのルート
Route::resource('boshujoho', BoshujohoController::class);

//マイページのルート（リソースコントローラーのルートより上に書かないとエラーになる）
Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost');

//マイコメントのルート（リソースコントローラーのルートより上に書かないとエラーになる）
Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');

//コメント保存用ルート
Route::post('post/comment/store', [CommentController::class, 'store'])->name('comment.store');

//postのリソースコントローラーのルート
Route::resource('post', PostController::class);

// お問い合わせ
Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

//プロフィール編集用ルート設定を追加
Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');


// 管理者用画面
Route::middleware(['can:admin'])->group(function () {
    //ユーザ一覧
    Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::delete('profile/{user}', [ProfileController::class, 'delete'])->name('profile.delete');

    Route::patch('roles/{user}/attach', [RoleController::class, 'attach'])->name('role.attach');
    Route::patch('roles/{user}/detach', [RoleController::class, 'detach'])->name('role.detach');
});

Route::get('/', function () {
    return view('welcome');
})->name('top');

//dashboardルーティング
Route::get('/dashboard', [BoshujohoController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
