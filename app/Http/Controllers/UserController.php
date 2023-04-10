<?php

namespace App\Http\Controllers;

use App\Models\MArea;
use App\Models\MCategory;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // ユーザー一覧表示（検索結果表示）
    public function index(Request $request)
    {
        // MCategoryテーブルの全てのデータを取得し、$categoriesに代入します。
        $categories = MCategory::all();
        // MAreaテーブルの全てのデータを取得し、$areasに代入します。
        $areas = MArea::all();
        // Userテーブルのデータを取得するためのクエリビルダー(PHPコードでSQLクエリを構築する機能)を作成します。
        $query = User::query();


        if ($request->filled('category')) {
            // $requestにcategoryが含まれている場合、$requestのcategoryの値に基づいて、クエリにwhere条件を追加
            $query->where('m_category_id', $request->category);
        }
        if ($request->filled('content')) {
            // $requestにcontentが含まれている場合
            $query->whereHas('contents', function ($subQuery) use ($request) {
                $subQuery->where('content', 'LIKE', '%' . $request->content . '%');
            });
        }
        if ($request->filled('area')) {
            // $requestにareaが含まれている場合、$requestのareaの値に基づいて、クエリにwhere条件を追加
            $query->where('m_area_id', $request->area);
        }
        if ($request->filled('age_from')) {
            // $requestにage_fromが含まれている場合、生年月日から年齢を計算してwhere条件を追加
            $query->whereRaw("TIMESTAMPDIFF(YEAR, birth, CURDATE()) >= ?", [$request->age_from]);
        }
        if ($request->filled('age_to')) {
            // $requestにage_toが含まれている場合、生年月日から年齢を計算してwhere条件を追加
            $query->whereRaw("TIMESTAMPDIFF(YEAR, birth, CURDATE()) <= ?", [$request->age_to]);
        }
        if ($request->filled('gender')) {
            // $requestにgenderが含まれている場合、$requestのgenderの値に基づいて、クエリにwhere条件を追加
            $query->where('gender', $request->gender);
        }
        if ($request->filled('level')) {
            // リレーションを定義して、学習レベルの条件を追加する
            $query->whereHas(
                'contents',
                function ($subQuery) use ($request) {
                    $subQuery->where('content', 'LIKE', '%' . $request->content . '%');
                    // contentsテーブルとusersテーブルのリレーションを定義し、contentsテーブルのlevelカラムの値が、
                    // リクエストパラメーターであるlevelの値と一致する場合に検索条件に追加する
                    $subQuery->where('level', $request->level);
                }
            );
        }

        // クエリを実行して、結果を$usersに代入します。
        $users = $query->get();

        return view('users.index', compact('users', 'categories', 'areas', 'request'));
    }

    // 友達一覧表示用
    public function friends(User $user)
    {
        $friends = $user->friends()->get();
        return view('users.friends', compact('user', 'friends'));
    }
}
