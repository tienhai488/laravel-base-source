<?php

namespace App\Http\Requests\User;

use App\Acl\Acl;
use App\Enum\Gender;
use App\Enum\UserStatus;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_USER_ADD);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_avatar' => 'nullable',
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'status' => [
                'required',
                new Enum(UserStatus::class),
            ],
            'phone_number' => [
                'required',
                'unique:user_profiles',
                new PhoneNumber,
            ],
            'date_of_birth' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                new Enum(Gender::class),
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'address' => [
                'required',
                'string',
                'max:255'
            ],
        ];
    }

    protected function passedValidation()
    {
        $this->merge(['password' => Hash::make($this->input('password'))]);
    }
}
