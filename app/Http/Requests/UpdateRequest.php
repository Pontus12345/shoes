<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateRequest extends Request
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
            'update_username' => 'required|alpha_num|min:3|max:32',
            'update_email' => 'required|email',
            'update_password' => 'required|min:3|confirmed',
            'update_password_confirmation' => 'required|min:3'
        ];
    }
}
