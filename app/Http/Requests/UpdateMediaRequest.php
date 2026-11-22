<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mediaId = $this->route('media');

        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($mediaId),
            ],
            'category' => 'sometimes|required|string|max:100',
            'genre' => 'sometimes|required|string|max:100',
            'description' => 'sometimes|required|string',
            'rating' => 'sometimes|required|numeric|min:0|max:10',
            'type' => 'sometimes|required|in:video,reading',
            'episode' => 'nullable|integer|min:1',
            'chapter' => 'nullable|integer|min:1',
        ];
    }
}
