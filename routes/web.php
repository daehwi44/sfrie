<?php

use App\Http\Controllers\BoshuCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BoshujohoController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\WelcomeController;

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

//chatのルート
Route::resource('/chat', ChatController::class);

//施設情報のルート
Route::get('shisetsu', [WelcomeController::class, 'shisetsu'])->name('shisetsu.index');

//学習コミュニティのルート
Route::resource('community', CommunityController::class)->except(['show']);
Route::get('community/{community_id?}', [CommunityController::class, 'show'])->name('community.show');


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

//postのルート
Route::get('community/{community_id?}/post', [PostController::class, 'index'])->name('post.index');
Route::get('community/{community_id?}/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('post', [PostController::class, 'store'])->name('post.store');
Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

//コミュニティ内のユーザー一覧のルート
Route::get('community/{community_id?}/members', [CommunityController::class, 'members'])->name('community.members');

//コミュニティ参加
Route::get('community/{community_id?}/add', [CommunityController::class, 'add'])->name('community.add');

// お問い合わせ
Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

//プロフィール編集用ルート設定を追加
Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

//プロフィール詳細表示
Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');


// 管理者用画面
Route::middleware(['can:admin'])->group(function () {
    //ユーザ一覧
    Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::delete('profile/{user}', [ProfileController::class, 'delete'])->name('profile.delete');

    Route::patch('roles/{user}/attach', [RoleController::class, 'attach'])->name('role.attach');
    Route::patch('roles/{user}/detach', [RoleController::class, 'detach'])->name('role.detach');
});


//welcomeルーティング
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//dashboardルーティング
Route::get('/dashboard', [WelcomeController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');



require __DIR__ . '/auth.php';
