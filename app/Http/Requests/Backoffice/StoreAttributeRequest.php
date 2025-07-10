<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreAttributeRequestInterface;
use Illuminate\Validation\Rule;

class StoreAttributeRequest extends BaseFormRequest implements StoreAttributeRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'attribute_type' => ['nullable', 'integer'],
            'order' => ['nullable', 'integer'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:categories,id'],
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
        return $this->null;
    }
}
