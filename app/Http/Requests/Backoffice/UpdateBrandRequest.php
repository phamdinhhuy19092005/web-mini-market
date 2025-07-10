<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\UpdateBrandRequestInterface;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends BaseFormRequest implements UpdateBrandRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],

            'image' => ['nullable', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['nullable', 'string', 'max:255'],

            'order' => ['nullable', 'integer'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,
        ]);
    }

    
    public function imageFile()
    {
        return null;
    }
}
