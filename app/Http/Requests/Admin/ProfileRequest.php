<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'type' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'status' => ['nullable'],
            'avatar' => ['nullable', 'mimes:png,jpg,svg', 'max:1024'],
        ];
        if ($this->user) {
            $rules['password'] = ['nullable'];
            $rules['email'] = ['unique:users,email,' . $this->user];
            $rules['phone'] = ['nullable', 'string', 'max:25', 'unique:users,phone,' . $this->user];
        } elseif ($this->new_admin) {
            $rules['email'] = ['unique:users,email,' . $this->new_admin];
            $rules['phone'] = ['nullable', 'string', 'max:25', 'unique:users,phone,' . $this->new_admin];
            $rules['password'] = ['nullable'];
        } else {
            $rules['email']  = ['required', 'email', 'string', 'max:100', 'unique:users,email,' . Auth::user()->id];
            $rules['phone'] = ['nullable', 'string', 'max:25', 'unique:users,phone,' . Auth::user()->id];
            $rules['password'] = ['nullable', 'confirmed'];
        }
        return $rules;
    }
}
