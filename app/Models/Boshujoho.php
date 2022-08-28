<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boshujoho extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'm_area_id',
        'm_category_id',
        'title',
        'content',
        'body',
        'image',
    ];

    //Userとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //M_areaとのリレーション
    public function area()
    {
        return $this->belongsTo(M_area::class);
    }

    //M_categoryとのリレーション
    public function category()
    {
        return $this->belongsTo(M_category::class);
    }
}
