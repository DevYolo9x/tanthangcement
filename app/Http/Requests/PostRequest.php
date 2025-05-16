<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'slug' =>  ['required', Rule::unique('router')->where(function ($query) {
                return $query->where('alanguage', config('app.locale'));
            })],
            'catalogue_id' => 'required|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'slug.required' => 'Đường dẫn bài viết là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn bài viết đã tồn tại.',
            'catalogue_id.gt' => 'Danh mục là trường bắt buộc.',
        ];
    }


}
