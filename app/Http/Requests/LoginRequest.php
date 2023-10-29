<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'email' => 'bail|required|exists:user',
            'password' => 'required'
        ];
    }

    public function messages():array
    {
        return [
            'email.required' => 'لطفا ایمیل خود را وارد کنید',
            'email.exists'=>'ایمیل ثبت نشده است؛ لطفا ثبت نام کنید',
            'password'=>'لطفا رمز عبور خود را وارد کنید'
        ];
    }
}
