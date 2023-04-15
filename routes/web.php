<?php

use App\Http\Controllers\BoshuCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoshujohoController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EventCommunityController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecommendedUserController;
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

// おすすめユーザー
Route::get('/recommended-user', [RecommendedUserController::class, 'index'])->name('recommended.index');

// チャット
Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
Route::post('/chat/{user}', [ChatController::class, 'send'])->name('chat.send');

// ユーザー一覧表示(検索結果も表示)
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// 友達一覧表示
Route::get('/users/{user}/friends', [UserController::class, 'friends'])->name('users.friends');

// 申請承認
Route::post('/friend-request/{id}/accept', [FriendRequestController::class, 'acceptFriendRequest'])->name('friend_request.accept');
// 申請拒否
Route::post('/friend-request/{id}/reject', [FriendRequestController::class, 'rejectFriendRequest'])->name('friend_request.reject');

// 申請一覧表示
Route::get('/friend-requests/{user}', [FriendRequestController::class, 'showFriendRequests'])->name('friend-requests.index');

// 友達申請用
Route::post('/friend-request', [FriendRequestController::class, 'sendFriendRequest'])->name('friend_request.send');

//施設情報のルート
Route::get('shisetsu', [WelcomeController::class, 'shisetsu'])->name('shisetsu.index');


// イベントコミュニティのindexへ
Route::get('eventcommunity', [EventCommunityController::class, 'index'])->name('event.index');
// イベントコミュニティのcreateへ
Route::get('eventcommunity/create', [EventCommunityController::class, 'create'])->name('event.create');
// イベントコミュニティのstoreへ
Route::post('ceventcommunity', [EventCommunityController::class, 'store'])->name('event.store');

//学習コミュニティのルート
Route::resource('community', CommunityController::class)->except(['show']);
Route::get('community/{community_id?}', [CommunityController::class, 'show'])->name('community.show');



//募集情報コメント保存用ルート
Route::post('boshujoho/boshucomment/store', [BoshuCommentController::class, 'store'])->name('boshucomment.store');

//boshujohoのリソースコントローラーのルート
Route::resource('boshujoho', BoshujohoController::class);

//マイページのルート（リソースコントローラーのルートより上に書かないとエラーになる）
// Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost');

//マイコメントのルート（リソースコントローラーのルートより上に書かないとエラーになる）
// Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');

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

//プロフィール編集用ルート設定を追加
Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

//プロフィール詳細表示
Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

//welcomeルーティング
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//dashboardルーティング
Route::get('/dashboard', [WelcomeController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');



require __DIR__ . '/auth.php';
