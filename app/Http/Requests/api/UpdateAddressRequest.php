<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAddressRequest extends FormRequest
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
        $address = $this->route('address');

        return [
            'title' => 'string',
            'address' => 'string',
            'latitude' => [
                'required',
                'numeric',
                Rule::unique('addresses')->ignore($address->id)->where(function ($query) use ($address) {
                    return $query->where('longitude', $address->longitude);
                }),
            ],
            'longitude' => [
                'required',
                'numeric',
                Rule::unique('addresses')->ignore($address->id)->where(function ($query) use ($address) {
                    return $query->where('latitude', $address->latitude);
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.required' => 'وارد کردن مختصات لازم است.',
            'latitude.numeric' => 'مختصات باید عدد باشد.',
            'latitude.unique' => 'مختصات وارد شده با همان طول جغرافیایی قبلاً ثبت شده است.',
            'longitude.required' => 'وارد کردن طول جغرافیایی لازم است.',
            'longitude.numeric' => 'طول جغرافیایی باید عدد باشد.',
            'longitude.unique' => 'مختصات وارد شده با همان عرض جغرافیایی قبلاً ثبت شده است.',
        ];
    }

}
