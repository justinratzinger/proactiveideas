<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class PostValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize():bool
    {
       return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        if(request()->isMethod(method:'POST')){
            return  [
                'title' => ['required', Rule::unique('posts'),'max:60'],
                'description' => ['required', Rule::unique('posts'),'max:255'],
                'body' => ['required', Rule::unique('posts'),'max:3000'],
                'tags' => 'required',
                'header_image' => 'required|url',
                'category_id' => 'required'
            ];
        }elseif(request()->isMethod(method:'PATCH')){
            return  [
                'title' => ['required', Rule::unique('posts')->ignore($this->post),'max:60'],
                'description' => ['required', Rule::unique('posts')->ignore($this->post),'max:255'],
                'body' => ['required', Rule::unique('posts')->ignore($this->post),'max:3000'],
                'tags' => 'required',
                'header_image' => 'required|url',
                'category_id' => 'required'
            ];

        }
    }
}
