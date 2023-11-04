<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodPartyRequest extends FormRequest
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
            'discount' => 'bail|required|numeric|between:0,100',
            'start_time' => 'bail|required|date|before:end_time',
            'end_time' => 'bail|required|date|after:start_time'
        ];
    }

    public function messages()
    {
        return [
            'start_time.required' => ' زمان شروع الزامی است.',
            'start_time.date' => ' زمان شروع باید یک تاریخ معتبر باشد.',
            'start_time.before' => 'زمان شروع باید قبل از زمان پایان باشد.',
            'end_time.required' => ' زمان پایان الزامی است.',
            'end_time.date' => ' زمان پایان باید یک تاریخ معتبر باشد.',
            'end_time.after' => 'زمان پایان باید پس از زمان شروع باشد.'
        ];
            }
}


