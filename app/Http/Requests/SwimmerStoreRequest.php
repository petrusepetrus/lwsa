<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsAdult;

class SwimmerStoreRequest extends FormRequest
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
        if($this->input('adult-swimmer')) {
            return [
                'first-name' => 'required',
                'last-name' => 'required',
                'date-of-birth' => ['required', 'date_format:Y-m-d', 'before:today', new IsAdult],
                'gender' => 'required|in:F,M',
                'email' => 'required_if:adult-swimmer,1|nullable|email:rfc',
                'mobile-phone' => 'required_if:adult-swimmer,1|nullable|max:11|phone:GB,mobile',
            ];
        }else{
            return [
                'first-name' => 'required',
                'last-name' => 'required',
                'date-of-birth' => ['required', 'date_format:Y-m-d', 'before:today'],
                'gender' => 'required|in:F,M',
                'email' => 'required_if:adult-swimmer,1|nullable|email:rfc',
                'mobile-phone' => 'required_if:adult-swimmer,1|nullable|max:11|phone:GB,mobile',
            ];
        }
    }

    /**
     * Customer messages for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first-name.required' => 'First Name is required',
            'last-name.required' => 'Last Name is required',
            'date-of-birth.required' => 'Date of Birth is required',
            'date-of-birth.before'=>'Date of Birth has to be earlier than today!',
            'gender.required' => 'Gender is required',
            'email.required_if' => 'Email is required for adult swimmers',
            'mobile-phone.required_if' => 'Mobile phone is required for adult swimmers',
            'mobile-phone.max' => 'Mobile phone can be a maximum of 11 numbers',
            'mobile-phone.phone' => 'Mobile phone is not a valid format',
        ];
    }
}
