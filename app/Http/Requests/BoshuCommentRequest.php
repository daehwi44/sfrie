<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BoshuCommentRequest extends FormRequest
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
            'body' => 'required|max:100'
        ];
    }

    // // エラーメッセージ設定
    // public function messages()
    // {
    //     return [
    //         'body.required' => 'コメントは100文字以内でお願いします。'
    //     ];
    // }
}
