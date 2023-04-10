<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'm_area_id',
        'm_category_id',
        'name',
        'image',
        'content',
        'about',
        'is_event',
        'event_date',
    ];

    //Userとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //MAreaとのリレーション
    public function area()
    {
        return $this->belongsTo(MArea::class, "m_area_id");
    }

    //MCategoryとのリレーション
    public function category()
    {
        return $this->belongsTo(MCategory::class, "m_category_id");
    }

    //Postとのリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // community_userの多対多リレーション
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
