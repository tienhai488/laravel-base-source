<?php

namespace App\Http\Requests\User;

use App\Acl\Acl;
use App\Enum\Gender;
use App\Enum\UserStatus;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_USER_EDIT);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
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
            'status' => [
                'required',
                new Enum(UserStatus::class),
            ],
            'phone_number' => [
                'required',
                Rule::unique('user_profiles')->ignore($this->user->userProfile->id),
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
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'address' => [
                'required',
                'string',
                'max:255'
            ],
        ];

        if (request()->password || request()->password_confirmation) {
            $rules['password'] = [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'confirmed',
            ];
        }

        return $rules;
    }
}
