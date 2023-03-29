<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //-------------------------------------------------------------
    // リレーション

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

    // -------------------------------------------------------------------
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
