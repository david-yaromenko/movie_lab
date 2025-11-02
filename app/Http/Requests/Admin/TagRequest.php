<?php

namespace App\Http\Requests\Admin;

use App\DTO\Admin\TagDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class TagRequest extends FormRequest
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
            'name' => 'required|array',
            'name.*' => 'string|max:255',
            'slug' => 'nullable|string|max:255'
        ];
    }

    public function toDto(): TagDTO
    {
        $slug = $this->input('slug');

        if (empty($slug)) {

            $slugBase = $this->input('name.en') ?? $this->input('name.uk') ?? 'tag';
            $slug = Str::slug($slugBase);
        }

        return new TagDTO(
            name: $this->input('name', []),
            slug: $slug
        );
    }
}
