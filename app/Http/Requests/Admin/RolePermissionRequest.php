<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
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
            'name'      => ['required', 'string', 'max:100', 'unique:roles,name,' . $this->role],
            'permissions' => ['required'],
        ];
        // For update
        if ($this->role) {
            $rules['name']           = [
                'nullable', 'string', 'max:100',
                $rules['permissions']    = ['nullable'],
            ];
        }
        return $rules;
    }
}
