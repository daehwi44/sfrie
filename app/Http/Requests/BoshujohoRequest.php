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
            'title' => 'required|max:100',
            'm_area_id' => 'required',
            'm_category_id' => 'required',
            'content' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|max:1024'
        ];
    }
}
