<?php

namespace App\Http\Requests\Admin;

use App\Factories\MovieDTOFactory;
use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_visible' => 'sometimes|boolean',
            'title' => 'required|array',
            'tags' => 'nullable|array',
            'tags.*' => 'int|min:1',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|array',
            'roles.*.*' => 'nullable|string|max:255|',
            'persons' => 'nullable|array',
            'persons.*' => 'int|min:1',
            'title.*' => 'string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'string',
            'poster' => 'nullable|image|max:2048',
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'nullable|image|max:2048',
            'trailer_id_youtube' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'watch_start_date' => 'nullable|date',
            'watch_end_date' => 'nullable|date|after_or_equal:watch_start_date',
        ];
    }

    public function messages()
    {
        return [
            'poster.image'    => 'File must be image.',
            'poster.max'      => 'The file is too large. Maximum size is 2 MB.',
        ];
    }

    public function toDto()
    {

        return MovieDTOFactory::fromRequest($this);
    }
}
