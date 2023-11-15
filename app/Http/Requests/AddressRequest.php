<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => 'required|string',
            'address' => 'required|string',
//            'latitude' => 'required|numeric',
//            'longitude' => 'required|numeric',
            'latitude' => [
                'required',
                'numeric',
                Rule::unique('addresses')->where(function ($query) {
                    return $query->where('longitude', $this->longitude);
                }),
            ],
            'longitude' => [
                'required',
                'numeric',
                Rule::unique('addresses')->where(function ($query) {
                    return $query->where('latitude', $this->latitude);
                }),
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'فیلد عنوان اجباری است.',
            'title.string' => 'فیلد عنوان باید از نوع رشته باشد.',
            'title.min' => 'فیلد عنوان باید حداقل دارای ۲ کاراکتر باشد.',
            'title.max' => 'فیلد عنوان باید حداکثر دارای ۲۵۵ کاراکتر باشد.',
            'address.required' => 'فیلد آدرس اجباری است.',
            'address.string' => 'فیلد آدرس باید از نوع رشته باشد.',
            'address.min' => 'فیلد آدرس باید حداقل دارای ۲ کاراکتر باشد.',
            'address.max' => 'فیلد آدرس باید حداکثر دارای ۲۵۵ کاراکتر باشد.',
            'latitude.required' => 'فیلد عرض جغرافیایی اجباری است.',
            'latitude.numeric' => 'فیلد عرض جغرافیایی باید یک عدد باشد.',
            'latitude.unique' => 'مقدار عرض جغرافیایی قبلاً استفاده شده است.',
            'longitude.required' => 'فیلد طول جغرافیایی اجباری است.',
            'longitude.numeric' => 'فیلد طول جغرافیایی باید یک عدد باشد.',
            'longitude.unique' => 'مقدار طول جغرافیایی قبلاً استفاده شده است.',
        ];
    }


}
