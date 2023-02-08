<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePostResponseRequest extends BaseRequest
{
    public function validationData()
    {
        $this->addParametersToRequest(['post_id' => $this->route('postId')]);
        return $this->all();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::guest();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'response' => ['required', 'string'],
            'image' => ['nullable'],
            'post_id' => ['required', 'exists:posts,id']
        ];
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(), [
            'user_id' => Auth::id()
        ]);
    }
}
