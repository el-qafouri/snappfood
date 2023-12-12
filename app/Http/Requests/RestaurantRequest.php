<?php

namespace App\Http\Requests;

use App\Enums\Day;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'restaurant_category_ids' => 'required',
            'selected_days' => 'required',
            'day',

            'credit_card_number' => [
                'required',
                'digits:10',
            ],


            'send_cost' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'open_time' => [
                'required',

            ],
            'close_time' => [
                'required',

            ]
        ];

    }
//    public function messages(): array
//    {
//        foreach (Day::getValues() as $day) {
//            $messages["open_time.$day.required"] = "زمان شروع کار در روز $day الزامی است.";
//            $messages["close_time.$day.required"] = "زمان شروع کار در روز $day الزامی است.";
////            $messages["open_time.$day.date_format"] = "زمان شروع کار در روز $day باید در فرمت ساعت:دقیقه (HH:mm) باشد.";
//            // و سایر پیام‌های مربوطه...
//        }
//        return [
//            'phone.required' => 'شماره تلفن را وارد کنید',
//            'restaurant_name.required' => 'نام رستوران را وارد کنید',
////            'address.required' => 'آدرس را وارد کنید',
//            'restaurant_category_id.required' => 'نوع رستوران را انتخاب کنید',
//            'credit_card_number.required' => 'شماره حساب را وارد کنید',
//            'credit_card_number.numeric' => 'شماره حساب باید یک عدد باشد',
//            'credit_card_number.min' => 'شماره حساب نباید کمتر از 10 رقم باشد',
//            'send_cost.required' => 'هزینه ارسال را وارد کنید',
//            'send_cost.numeric' => 'هزینه ارسال باید یک عدد باشد',
////            'open_time.required' => 'زمان شروع کار الزامی است.',
////            'open_time.before' => 'زمان شروع باید قبل از زمان پایان باشد.',
////            'close_time.required' => 'زمان پایان کار رستوران الزامی است.',
////            'close_time.after' => 'زمان پایان باید پس از زمان شروع باشد.',
////            'open_time.after_or_equal' => 'زمان شروع کار باید بعد یا مساوی 09:00 باشد.',
////            'close_time.before_or_equal' => 'زمان پایان کار باید قبل یا مساوی 23:59 باشد.',
//            'day.required' => 'یک روز را وارد کنید',
//$messages,
//
//        ];


}
