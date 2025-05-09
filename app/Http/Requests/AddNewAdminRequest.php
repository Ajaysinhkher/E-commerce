<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd('hii');
        return [
           'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6', // Password is optional for update
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
