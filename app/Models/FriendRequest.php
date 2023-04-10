<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'friend_requests'; // テーブル名
    protected $primaryKey = 'id'; // 主キーのカラム名
    public $timestamps = true; // タイムスタンプのカラムを使用するかどうか
    protected $fillable = [ // 変更可能なカラム名
        'user_id',
        'requested_user_id',
        'status',
    ];


    public static function receivedPendingRequests($userId)
    {
        return self::where('requested_user_id', $userId)->where('status', 0)->get();
    }
}
