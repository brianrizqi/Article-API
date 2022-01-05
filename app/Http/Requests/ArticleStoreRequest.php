<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleStoreRequest extends FormRequest
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
            'data.attributes.category_id' => ['required', Rule::exists('categories', 'id')->whereNull('deleted_at')],
            'data.attributes.title' => ['required', 'max:100'],
            'data.attributes.description' => ['required', 'max:200'],
            'data.attributes.content' => ['required'],
            'data.attributes.tags' => ['required', 'array']
        ];
    }
}
