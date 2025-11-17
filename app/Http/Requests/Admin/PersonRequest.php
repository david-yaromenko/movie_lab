<?php

namespace App\Http\Requests\Admin;

use App\DTO\Admin\PersonDTO;
use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'types' => 'required|in:director,screenwriter,actor,composer|array',
            'types.*' => 'string|min:1',
            'name' => 'required|array',
            'name.*' => 'string|max:255',
            'tags' => 'required|array',
            'tags.*' => 'int|min:1',
            'poster' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'poster.image'    => 'Photo must be image.',
            'poster.max'      => 'The Photo is too large. Maximum size is 2 MB.',
            'poster.uploaded' => 'Photo not download. Try again.',
        ];
    }
    public function toDto()
    {

        $photoPath = null;
        if ($this->hasFile('photo')) {
            $photoPath = $this->file('photo')->store('photo', 'public');
        }

        return new PersonDTO(
            types: $this->input('types', []),
            name: $this->input('name', []),
            tagsIds: $this->input('tags', []),
            photo: $photoPath
        );
    }
}
