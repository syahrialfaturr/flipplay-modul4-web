<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:media,title',
            'category' => 'required|string|max:100',
            'genre' => 'required|string|max:100',
            'description' => 'required|string',
            'rating' => 'required|numeric|min:0|max:10',
            'type' => 'required|in:video,reading',
            'episode' => 'nullable|integer|min:1',
            'chapter' => 'nullable|integer|min:1',
        ];
    }
}
