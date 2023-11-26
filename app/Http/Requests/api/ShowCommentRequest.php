<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class ShowCommentRequest extends FormRequest
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
            'food_id' => 'nullable|exists:foods,id',
            'restaurant_id' => 'nullable|exists:restaurants,id',
        ];
    }

    public function messages(): array
    {
        return [
            'food_id.nullable' => 'وارد کردن آیدی غذا الزامی است.',
            'food_id.exists:foods,id' => 'این غذا وجود ندارد.',

            'restaurant_id.required' => 'وارد کردن آیدی رستوران الزامی است.',
            'restaurant_id.exists:restaurants,id' => 'این رستوران وجود ندارد.',

        ];
    }
}
