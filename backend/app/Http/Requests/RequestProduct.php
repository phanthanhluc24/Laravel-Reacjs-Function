<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->isMethod("post")) {
            return [
                "name" => "required|string|max:50",
                "description" => "required|string",
                "amount" => "required|integer",
                "price" => "required|numeric|between:0,999999.99",
                "image" => "required|image|mimes:png,jpg|max:2048",
            ];
        } else {
            return [
                "name" => "required|string|max:258",
                "description" => "required|string",
                "amount" => "required|integer",
                "price" => "required|numeric|between:0,999999.99",
                "image" => "nullable|image|mimes:png,jpg|max:2048",
            ];
        }
    }

    public function messages()
    {
        if ($this->isMethod("post")) {
            return [
                "name.required" => "Name is required",
                "description.required" => "Description is required",
                "amount.required" => "Amount is required",
                "price.required" => "Price is required",
                "image.required" => "Image is required",
                "price.between" => "Price must be between 0 and 999999.99",
                "image.image" => "Invalid image format",
                "image.mimes" => "Image must be a PNG or JPG file",
                "image.max" => "Image size must not exceed 2048 KB",
            ];
        } else {
            return [
                "name.required" => "Name is required",
                "description.required" => "Description is required",
                "amount.required" => "Amount is required",
                "price.required" => "Price is required",
                "price.between" => "Price must be between 0 and 999999.99",
                "image.image" => "Invalid image format",
                "image.mimes" => "Image must be a PNG or JPG file",
                "image.max" => "Image size must not exceed 2048 KB",
            ];
        }
       
    }
}
