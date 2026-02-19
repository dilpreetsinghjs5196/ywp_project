<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'designation' => 'required|string|max:255',
            'fees' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'mode' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'specialization' => 'nullable|string',
            'specialties' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'session_type' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'availability_type' => 'nullable|in:date,weekly',
            'availability' => 'nullable|array',
            'weekly_availability' => 'nullable|array',
        ];
    }
}
