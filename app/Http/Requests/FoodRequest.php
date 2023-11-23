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
//            "name" => ['bail',"required", "string",'min:2','max:25','unique:foods', "max:255"],
            "name" => [
                'bail',
                'required',
                'string',
                'min:2',
                'max:255',
//                'unique:foods,name,NULL,id,user_id,' . auth()->id()
                'unique:foods,name,NULL,id,user_id,' . auth()->user()->restaurant->id,
            ],
            "price" => ['bail', 'required', 'numeric', 'min:0'],
            "material" => ['bail', 'required', 'string', 'min:2' , 'max:255'],
            "food_category_id" => ['required' , 'array' , 'min:1'],
//            "discount" => 'nullable',
            'discount_id' => 'nullable|exists:discounts,id',
//            "imagePath" => 'image|mimes:jpg,jpeg,png|max:2048|dimensions:max_width=1000,max_height=1000',
            "image_path" => 'image|mimes:jpg,jpeg,png',
//            "image" => 'max:1',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'نام غذا الزامی است',
            'name.string' => 'نام غذا باید یک رشته باشد',
            'name.min' => 'نام غذا حداقل باید دارای 2 کاراکتر باشد',
            'name.max' => 'نام غذا حداکثر می‌تواند 255 کاراکتر داشته باشد',
            'name.unique' => 'نام غذا قبلاً استفاده شده است',

            'price.required' => 'قیمت غذا الزامی است',
            'price.numeric' => 'قیمت غذا باید یک عدد باشد',
            'price.min' => 'قیمت غذا نمی‌تواند منفی باشد',

            'material.required' => 'مواد غذا الزامی است',
            'material.string' => 'مواد غذا باید یک رشته باشد',
            'material.min' => 'مواد غذا حداقل باید دارای 2 کاراکتر باشد',
            'material.max' => 'مواد غذا حداکثر می‌تواند 255 کاراکتر داشته باشد',

            'food_category_id.required' => 'دسته بندی غذا الزامی است',

            'discount.nullable' => 'میتوانید تخفیف اعمال نکنید',

            'image_path.image' => 'فایل باید تصویری باشد',
            'image_path.required' => 'آپلود تصویر الزامی است',
            'image_path.mimes' => 'فرمت تصویر باید jpg، jpeg، یا png باشد',

        ];

    }

}
