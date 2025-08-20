<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteSettingUpdateRequest extends FormRequest
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
            'website_name' => 'required|string|max:255',
            'website_description' => 'required',
            'website_icon' => 'image|mimes:jpeg,png,jpg,gif|max:9048',
            'website_address' => 'required',
            'website_phone' => 'required',
            'website_email' => 'required',
            'website_instagram' => 'nullable',
            'website_x' => 'nullable',
            'website_youtube' => 'nullable',
            'website_facebook' => 'nullable',
        ];
    }
}
