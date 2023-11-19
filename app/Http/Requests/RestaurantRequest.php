<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'restaurant_name' => 'required',
            'phone' => 'required',
//            'phone' => 'required|regex:/^09[0-9]{9}$/',
            'address' => 'required',
            'credit_card_number' => 'bail|required|numeric|min:10',
//            'restaurant_category_id' => 'required',
            'restaurant_category_ids' => ['required' , 'array' , 'min:1'],
//            'credit_card_number' => 'bail|required|numeric|size:10',
            'send_cost' => 'bail|required|numeric',
//            'open_time' => 'bail|required|before:close_time',
//            'close_time' => 'bail|required|after:open_time'

            'open_time' => [
                'bail',
                'required',
                'date_format:H:i', // فرمت ساعت
                'after_or_equal:09:00', // بررسی اینکه ساعت انتخابی بزرگتر یا مساوی 09:00 باشد
                'before_or_equal:23:59', // بررسی اینکه ساعت انتخابی کوچکتر یا مساوی 23:59 باشد
            ],
            'close_time' => [
                'bail',
                'required',
                'date_format:H:i', // فرمت ساعت
                'after_or_equal:09:00', // بررسی اینکه ساعت انتخابی بزرگتر یا مساوی 09:00 باشد
                'before_or_equal:23:59', // بررسی اینکه ساعت انتخابی کوچکتر یا مساوی 23:59 باشد
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'شماره تلفن را وارد کنید',
//            'phone.regex' => 'شماره تلفن معتبر نیست',
            'restaurant_name.required' => 'نام رستوران را وارد کنید',
            'address.required' => 'آدرس را وارد کنید',
            'restaurant_category_id.required' => 'نوع رستوران را انتخاب کنید',
            'credit_card_number.required' => 'شماره حساب را وارد کنید',
            'credit_card_number.numeric' => 'شماره حساب باید یک عدد باشد',
            'credit_card_number.min' => 'شماره حساب نباید کمتر از 10 رقم باشد',
            'send_cost.required' => 'هزینه ارسال را وارد کنید',
            'send_cost.numeric' => 'هزینه ارسال باید یک عدد باشد',
            'open_time.required' => 'زمان شروع کار الزامی است.',
            'open_time.before' => 'زمان شروع باید قبل از زمان پایان باشد.',
            'close_time.required' => 'زمان پایان کار رستوران الزامی است.',
            'close_time.after' => 'زمان پایان باید پس از زمان شروع باشد.',
            'open_time.after_or_equal' => 'زمان شروع کار باید بعد یا مساوی 09:00 باشد.',
            'close_time.before_or_equal' => 'زمان پایان کار باید قبل یا مساوی 23:59 باشد.'

        ];
    }
}
