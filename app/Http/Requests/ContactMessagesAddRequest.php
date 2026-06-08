<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMessagesAddRequest extends FormRequest
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
				"name" => "required|string",
				"email" => "required|email",
				"phone" => "nullable|string",
				"subject" => "nullable|string",
				"message" => "nullable",
				"is_read" => "required|numeric",
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
