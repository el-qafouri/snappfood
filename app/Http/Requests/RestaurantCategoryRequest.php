<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantCategoryRequest extends FormRequest
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
            "name"=>'required',
            "description"=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'please insert restaurant category name',
            'description.required' => 'please insert restaurant category description',

        ];
    }
}
