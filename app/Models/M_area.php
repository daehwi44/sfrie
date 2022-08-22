<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_area extends Model
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
}
