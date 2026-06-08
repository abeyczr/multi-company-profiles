<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfoliosEditRequest extends FormRequest
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
            
				"company_id" => "filled",
				"category_id" => "filled",
				"title" => "filled|string",
				"description" => "nullable",
				"image" => "nullable",
				"project_year" => "nullable|string",
				"client_name" => "nullable|string",
				"status" => "filled",
            
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
