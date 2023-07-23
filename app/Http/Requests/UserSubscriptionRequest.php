<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|int|exists:users,id',
            'subscription_id' => 'required|int|exists:subscriptions,id,deleted_at,NULL'
        ];
    }

    public function getValidatorInstance(): Validator
    {
        $this->payload();
        return parent::getValidatorInstance();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'Bad Request | Failure',
            'errors' => $validator->errors()
        ], 422));
    }

    private function payload()
    {
        $this->merge([
            'renewed_at' => Carbon::now(),
            'expired_at' => Carbon::now()->addMonth(),
        ]);
    }
}
