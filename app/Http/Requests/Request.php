<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

	public function rules()
    {
        return [
        	'reply_content' => 'required|min:10|max:222',
        ];
    }
}
