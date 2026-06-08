<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogsAddRequest extends FormRequest
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
				"slug" => "required|string",
				"thumbnail" => "nullable|string",
				"content" => "nullable",
				"published_at" => "nullable|date",
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
