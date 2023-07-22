<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function getValidatorInstance(): Validator
    {
//        $this->payload();
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
                'email' => "The e-mail must be entered in the correct format."
            ],
            'password' => "Password field is required"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'Bad Request | Failure',
            'errors' => $validator->errors()
        ], 401));
    }

//    protected function payload()
//    {
//        //payload code
//    }
}
