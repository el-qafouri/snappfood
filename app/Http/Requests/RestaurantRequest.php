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
            'credit_card_number' => 'required',
            'send_cost' => 'required',
        ];
    }

    public function messages():array
    {
        return [
        'phone.required'=>'شماره تلفن را وارد کنید',
        'restaurant_name.required'=>'اسم رستوران را وارد کنید',
        'restaurant_address.required'=>'آدرس را وارد کنید',
        'restaurant_category_id.required'=>'نوع رستوران را انتخاب کنید',
        'credit_card_number.required'=>'شماره حساب را وارد کنید',
        'send_cost.required'=>'هزینه ارسال را وارد کنید'
        ];
    }
}
