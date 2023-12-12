<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required|min:2',
            'email'=>'required|unique:users',
            'phone'=>'required|unique:users',
            'password'=>'required|confirmed|min:4|max:14',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'لطفا نام خود را وارد کنید',
            'name.min' => 'لطفا نام خود را به طور کنید',
            'email.unique' => 'ایمیل قبلا ثبت شده است',
            'email.required' => 'لطفا ایمیل خود را وارد کنید',
            'phone.unique' => 'شماره همراه قبلا ثبت شده است',
            'phone.required' => 'لطفا شماره همراه خود را وارد کنید',
            'password.required' => 'لطفا رمز عبور خود را وارد کنید',
            'password.confirmed' => 'پسوردها مطابقت ندارند',
            'password.min' => 'پسورد نباید کمتر از 4 کاراکتر باشد',
            'password.max' => 'پسورد نباید بیشتر از 14 کاراکتر باشد',
        ];
    }
}
