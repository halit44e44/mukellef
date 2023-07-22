<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string' ,
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ];
    }

    public function getValidatorInstance(): Validator
    {
        return parent::getValidatorInstance();
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'email' => [
                'required' => "Email field is required",
                'email' => "The e-mail must be entered in the correct format.",
                'unique' => "This field must be unique"
            ],
            'password' => [
                'required' => "Password field is required",
                'confirmed' => "The password field confirmation does not match."
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'Bad Request | Failure',
            'errors' => $validator->errors()
        ], 401));
    }
}
