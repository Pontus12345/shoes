<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;

class CommentsRequest extends Request
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
            'comments_username' => 'required|min:5|max:300',
            'comments_content' => 'required|min:10|max:1000',
            'You_need_to_check_a_star' => 'required|integer'
        ];
    }
}
