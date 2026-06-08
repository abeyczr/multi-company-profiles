<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProfilesAddRequest extends FormRequest
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
            
				"company_name" => "required|string",
				"tagline" => "nullable|string",
				"description" => "nullable",
				"vision" => "nullable",
				"mission" => "nullable",
				"address" => "nullable|string",
				"phone" => "nullable|string",
				"email" => "nullable|email",
				"website" => "nullable|string",
				"logo" => "nullable|string",
				"favicon" => "nullable|string",
				"status" => "required",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
