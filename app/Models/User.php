<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use App\Models\FriendRequest;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'm_area_id',
        'm_category_id',
        'gender',
        'birth',
        'intro',
        'avatar',
        'email',
        'password',
        'isFriend',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //-------------------------------------------------------------
    // リレーション
    //-------------------------------------------------------------
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function boshujohos()
    {
        return $this->hasMany(Boshujoho::class);
    }

    public function communities()
    {
        return $this->hasMany(Community::class);
    }


    // Userの都道府県の取得(MAreaモデルとのリレーション)
    public function mArea()
    {
        return $this->belongsTo(MArea::class);
    }

    // Userのカテゴリーの取得(MCategoryモデルとのリレーション)
    public function mCategory()
    {
        return $this->belongsTo(MCategory::class);
    }

    // community_userの多対多リレーション
    public function communitiesMany()
    {
        return $this->belongsToMany(Community::class);
    }


    // contentsテーブルとのリレーション
    public function contents()
    {
        return $this->hasMany(Content::class, 'user_id');
    }

    // 引数として渡されたrequested_user_idに対するフレンドリクエストが存在するかどうかの判定
    public function isFriendRequested($requestedUserId)
    {
        return $this->friendRequests()->where('requested_user_id', $requestedUserId)->exists();
    }

    // FriendRequestとのリレーション
    public function friendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'user_id');
    }

    // 友達取得用
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'user_id', 'requested_user_id')
            ->withPivot('status')
            ->wherePivot('status', 1);
    }

    // チャットボタン表示用
    public function isFriend($user_id)
    {
        // friend_requestsテーブルに、user_idがログインユーザーのIDで、requested_user_idが引数の$user_idで、statusが1(友達)のレコードがあるかどうかをチェックする
        $is_friend = FriendRequest::where('user_id', Auth::id())
            ->where('requested_user_id', $user_id)
            ->where('status', 1)
            ->exists();
        return $is_friend;
    }
}
