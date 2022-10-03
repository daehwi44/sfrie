<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BoshujohoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //ログインユーザーのみフォーム使用を許可
        // if (Auth::check()) {
            return true;
        // } else {
        //     return false;
        // }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        Log::info('Logに出力してこの関数が通っているか確認する');
        return [
            'title' => 'required|max:10',
            'm_area_id' => 'required',
            'm_category_id' => 'required',
            'content' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|max:1024'
        ];
    }

    // エラーメッセージ設定
    public function messages()
    {
        Log::info('Logに出力してこの関数が通っているか確認する2');
        return [
            'title.required' => 'あああああああああああああ',
            'title.max' => 'いいいいいいいいいいいいいい',
            // 'm_area_id.required' => 'エリアを選択してください。',
            // 'm_category_id.required' => 'カテゴリを選択してください。',
            // 'content.required' => '学習内容を選択してください。',
            // 'body.required' => '本文は1000文字以内でお願いします。',
            // 'image.required' => 'ファイル名は1024文字までです。',
        ];
    }
}
