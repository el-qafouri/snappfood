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
            'phone' => 'required',
            'restaurant_name' => 'required',
            'address' => 'required',
            'restaurant_category_id' => 'required',
            'credit_card_number' => 'bail|required|numeric|min:10',
            'send_cost' => 'bail|required|numeric',
            'open_time' => 'bail|required|before:close_time',
            'close_time' => 'bail|required|after:open_time'
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'شماره تلفن را وارد کنید',
            'restaurant_name.required' => 'اسم رستوران را وارد کنید',
            'restaurant_address.required' => 'آدرس را وارد کنید',
            'restaurant_category_id.required' => 'نوع رستوران را انتخاب کنید',
            'credit_card_number.required' => 'شماره حساب را وارد کنید',
            'credit_card_number.numeric' => 'شماره حساب را به عدد وارد کنید',
            'credit_card_number.min:10' => 'شماره حساب باید 10 رقم باشد',
            'send_cost.required' => 'هزینه ارسال را وارد کنید',
            'send_cost.numeric' => 'هزینه ارسال را به عدد وارد کنید',
            'open_time.required' => ' زمان شروع کار الزامی است.',
            'open_time.before' => 'زمان شروع باید قبل از زمان پایان باشد.',
            'close_time.required' => ' زمان پایان کار رستوران الزامی است.',
            'close_time.after' => 'زمان پایان باید پس از زمان شروع باشد.'
        ];
    }
}
