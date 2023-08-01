<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class StoreScholarshipApplicationsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|unique:scholarship_applications',
            'gender' => 'required|string',
            'lga' => 'required|string',
            'dob' => 'required|string',
            'form_of_disability' => 'required|string',
            'programme_of_study' => 'required|string',
            'course_of_study' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["status" => 'error', "message" => 'validation error', "data" => $validator->errors()->messages()], 422));
    }
}
