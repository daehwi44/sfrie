<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:10',
            'm_area_id' => 'required',
            'm_category_id' => 'required',
            'content' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|max:1024'
        ];
    }

    // // エラーメッセージ設定
    // public function messages()
    // {
    //     return [
    //         'title.required' => 'タイトルは10文字以内でお願いします。',
    //         'm_area_id.required' => 'エリアを選択してください。',
    //         'm_category_id.required' => 'カテゴリを選択してください。',
    //         'content.required' => '学習内容を選択してください。',
    //         'body.required' => '本文は1000文字以内でお願いします。',
    //         'image.required' => 'ファイル名は1024文字までです。',
    //     ];
    // }
}
