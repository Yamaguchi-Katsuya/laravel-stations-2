<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CreateMovieRequest extends FormRequest
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
            'title' => ['required', 'unique:movies'],
            'image_url' => ['required', 'url'],
            'published_year' => ['required', 'gte:1900'],
            'description' => ['required'],
            'is_showing' => ['required', 'boolean'],
            'genre' => ['required'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('is_showing')) {
            $this->merge(['is_showing' => (bool) $this->is_showing]);
        }
    }
}
