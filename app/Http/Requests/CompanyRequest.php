<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:10',
            'account_id' => 'required',
            'type' => 'required',
            'status' => 'required',
        ];
    }

     public function messages()
    {
        return [
            'required' => 'The :attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => "Company Name",
            'description' => "Company Description",
            'account_id' => "Account Type is Specified",
            'type' => "Type",
            'status' => "Status",
        ];
    }
}
