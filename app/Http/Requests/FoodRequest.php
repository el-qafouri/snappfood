<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            "name" => ['bail',"required", "string",'min:2','max:25','unique:food', "max:255"],
            "price" => ['bail', 'required', 'numeric', 'min:0'],
            "material" => ['bail', 'required', 'string', 'min:2' , 'max:255'],
            'food_category_id' => 'required',
        ];
    }
}
