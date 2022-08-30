<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
    ];

    /**
     * カテゴリーに紐付くUserの取得(Userモデルとのリレーション)
     */
    public function users()
    {
        return $this->hasMany(user::class, 'm_category_id', 'id');
    }

    /**
     * Boshujohoモデルとのリレーション
     */
    public function boshujohos()
    {
        return $this->hasMany(Boshujoho::class);
    }

    /**
     * Communityモデルとのリレーション
     */
    public function communities()
    {
        return $this->hasMany(Community::class);
    }
}
