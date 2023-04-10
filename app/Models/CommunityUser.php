<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityUser extends Model
{
    use HasFactory;

    // 参照させたいSQLのテーブル名を指定してあげる
    // 公式ドキュメントによると、自分で命名したデータベースをLaravelに参照させたいときは、テーブル名をモデルファイル内で指定しなければいけない
    protected $table = 'community_user';
}
