<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroBannersAddRequest extends FormRequest
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
            
				"company_id" => "required",
				"title" => "required|string",
				"subtitle" => "nullable|string",
				"button_text" => "nullable|string",
				"button_link" => "nullable|string",
				"background_image" => "nullable",
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
