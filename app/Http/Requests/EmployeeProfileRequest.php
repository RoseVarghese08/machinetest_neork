<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'contact_number' =>'required|numeric',
            'hobby_id' => 'required|exists:hobbies,id',
            'category_id' => 'required|exists:categories,id',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file upload rules
        ];
    }
}

