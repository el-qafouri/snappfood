<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
            'alt' => 'required',
            'title' => 'required',
            'image_path' => 'required',
            'link' => 'nullable|url',
            'is_active' => 'required|boolean',
        ];
    }


    public function messages(): array
    {
        return [
            'alt.required' => 'وارد کردن فیلد alt الزامی است.',
            'title.required' => 'وارد کردن فیلد title الزامی است.',
            'image_path.required' => 'وارد کردن فیلد عکس الزامی است.',
            'link.url' => 'فرمت لینک وارد شده صحیح نمی‌باشد.',
            'is_active.required' => 'مشخص کردن فعال یا غیرفعال بودن بنر الزامی است.',
            'is_active.boolean' => 'باید یک مقدار صحیح یا غیرصحیح باشد.',
        ];
    }
}
