<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $ktut
 * @property-read string $stir
*/
class AwoiLoginRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->guest();
    }

    public function rules()
    {
        return [
            'stir' => ['required'],
            'ktut' => ['required']
        ];
    }
}
