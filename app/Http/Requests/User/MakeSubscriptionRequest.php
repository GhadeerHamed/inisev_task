<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MakeSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.website_id' => 'required|integer|exists:websites,id',
            'data.user_id' => 'required|integer|exists:users,id',
        ];
    }
}
