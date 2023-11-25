<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'فیلد عنوان الزامی است.',
            'title.string' => 'فیلد عنوان باید یک رشته باشد.',
            'title.max' => 'عنوان نمی‌تواند بیشتر از 255 کاراکتر باشد.',

            'address.required' => 'فیلد آدرس الزامی است.',
            'address.string' => 'فیلد آدرس باید یک رشته باشد.',
            'address.max' => 'آدرس نمی‌تواند بیشتر از 255 کاراکتر باشد.',

            'latitude.required' => 'فیلد عرض جغرافیایی الزامی است.',
            'latitude.numeric' => 'فیلد عرض جغرافیایی باید یک عدد باشد.',

            'longitude.required' => 'فیلد طول جغرافیایی الزامی است.',
            'longitude.numeric' => 'فیلد طول جغرافیایی باید یک عدد باشد.',
        ];
    }
}
