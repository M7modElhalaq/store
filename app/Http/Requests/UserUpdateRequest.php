<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => [
                'email',
                'required',
                Rule::unique('users')->ignore($this->user)
            ],
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required',
            'role_id' => 'required',
            'country' => 'required',
        ];
    }
}
