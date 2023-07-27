<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Rules\ValidMobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use App\Enums\User\DeviceTypeEnums;

class SignUpRequest extends FormRequest
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
            'first_name' => ['required','string'],
			'last_name' => ['required','string'],
			'email' => ['required','email'],
			'device_type' => ['required', new Enum(DeviceTypeEnums::class)],
			'mobile' => ['required', new ValidMobile(),'unique:users,mobile'],
			'password' => [
				'required',
				Password::min(8)
			]
        ];
    }
}
