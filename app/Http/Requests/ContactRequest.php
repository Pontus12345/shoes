<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
            'name_contact' => 'required|alpha_num|min:10|max:300',
            'email_contact' => 'required|email',
            'text_contact' => 'required|alpha_num|min:10|max:1000',
        ];
    }
}
