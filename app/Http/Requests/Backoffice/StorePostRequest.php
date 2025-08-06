<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationFE;
use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StorePostRequestInterface;
use Illuminate\Validation\Rule;

class StorePostRequest extends BaseFormRequest implements StorePostRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],

            'image' => ['required', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['nullable', 'string'],

            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
            'display_on_frontend' => ['required', Rule::in(ActivationFE::all())],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'code' => ['nullable', 'string', 'max:100'],
            'view_count' => ['nullable', 'integer', 'min:0'],
            'author' => ['required', 'string', 'max:255'],
            'post_category_id' => ['required', 'integer', 'exists:post_categories,id'],
            'content' => ['nullable', 'string'],
            'post_at' => ['nullable', 'date'],

        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN) ? ActivationStatus::ACTIVE : ActivationStatus::INACTIVE,
            'display_on_frontend' => filter_var($this->display_on_frontend, FILTER_VALIDATE_BOOLEAN) ? ActivationFE::ACTIVE : ActivationFE::INACTIVE,
        ]);
    }


    public function imageFile()
    {
        return $this->file('image');
    }
}
