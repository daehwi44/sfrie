<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecommendedUserController extends Controller
{
    public function index()
    {
        $users = User::with('MArea', 'MCategory', 'contents')->get();
        $scores = $this->calculateRecommendationScores($users);
        $recommendations = User::whereIn('id', array_keys($scores))->get();

        return view('users.recommended', [
            'recommendations' => $recommendations, 'scores' => $scores,
        ]);
    }

    public function calculateRecommendationScores($users)
    {
        $scores = [];

        foreach ($users as $user) {
            if ($user->id == Auth::id()) {
                continue;
            }

            $score = Auth::user()->calculateSimilarity($user);

            // 20％以上のみおすすめユーザー表示
            if ($score > 50) {
                $scores[$user->id] = $score;
            }
        }

        arsort($scores); // スコアを降順にソートする

        return $scores;
    }
}
