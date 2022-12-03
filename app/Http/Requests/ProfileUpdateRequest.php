<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            'username' => ['string','required','max:255','alpha_dash',Rule::unique('users')->ignore($this->user)],
            'name' => ['string', 'required', 'max:255'],
            'avatar' => ['image'],
            'email' => ['string','required','email','max:255',Rule::unique('users')->ignore($this->user)],
            'password' => ['string','required','min:8','max:255','confirmed'],
        ];
    }
}
