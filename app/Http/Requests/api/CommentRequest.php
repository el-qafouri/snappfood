<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'order_id' => 'required',
            'food_id' => 'required',
            'score' => 'required|integer|min:1|max:5',
            'message' => 'required|string'
        ];
    }


    public function messages()
    {
        return [
            'order_id.required' => 'وارد کردن آیدی سفارش الزامی است.',
            'food_id.required' => 'وارد کردن آیدی غذا الزامی است.',

            'score.required' => 'فیلد رتبه الزامی است.',
            'score.min:1' => 'باید حداقل یک باشد.',
            'score.max:5' => 'باید حداکثر پنج باشد.',
            'score.integer' => 'باید مقدار عددی باشد.',

            'message.required' => 'متن پیام الزامی است',
            'message.string' => 'باید حروف وارد کنید.',
        ];
    }
}
