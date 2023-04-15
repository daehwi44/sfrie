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


    // おすすめユーザーを取得
    public function calculateSimilarity(User $user)
    {
        $score = 0;

        // 1. 居住エリアが同じ場合：10点
        if ($this->m_area_id == $user->m_area_id) {
            $score += 10;
        }

        // 2. 興味のある学習カテゴリーが同じ場合：8点
        if ($this->m_category_id == $user->m_category_id) {
            $score += 8;
        }

        // 3. 学習内容が同じ場合：10点
        $this_contents = $this->contents()->pluck('content')->toArray();
        $user_contents = $user->contents()->pluck('content')->toArray();
        if (count(array_intersect($this_contents, $user_contents)) > 0) {
            $score += 10;
        }


        // 4. 年齢が近い場合（10歳以内）：3点
        $age_diff = abs(\Carbon\Carbon::parse($this->birth)->diffInYears(\Carbon\Carbon::parse($user->birth)));
        if ($age_diff <= 10) {
            $score += 3;
            // 年齢が近い場合（5歳以内）：5点(さらに２点)
            if ($age_diff <= 5) {
                $score += 2;
                // 年齢が近い場合（10歳以内）：7点(さらに２点)
                if ($age_diff <= 3) {
                    $score += 2;
                }
            }
        }

        // 5. 性別が同じ場合：3点
        if ($this->gender == $user->gender) {
            $score += 3;
        }

        // おすすめ度を計算する
        $similarity = round(($score / 38) * 100); // 合計点数は38点満点とする

        return $similarity;
    }
}
