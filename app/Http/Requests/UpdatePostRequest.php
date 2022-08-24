<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required|min:3|unique:posts,title,".$this->route('post')->id,
            "description" => "required|min:10",
            "category" => "required|exists:categories,id", // exists is for checking database if it exist
            "feature_image" => "nullable|mimes:png,jpeg|file|max:521"
        ];
    }
}
