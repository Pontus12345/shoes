<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'Reg_username' => 'required|alpha_num|min:3|max:32',
            'Reg_email' => 'required|email',
            'Reg_password' => 'required|min:3|confirmed',
            'Reg_password_confirmation' => 'required|min:3'
        ];
    }
}
