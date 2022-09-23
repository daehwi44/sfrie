<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MArea extends Model
{
    use HasFactory;
    protected $fillable = [
        'area',
    ];

    /**
     * 都道府県に紐付くUserの取得(Userモデルとのリレーション)
     */
    public function users()
    {
        return $this->hasMany(user::class, 'm_area_id', 'id');
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
