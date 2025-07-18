<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreAttributeValueRequestInterface;
use Illuminate\Validation\Rule;

class StoreAttributeValueRequest extends BaseFormRequest implements StoreAttributeValueRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'value' => ['required', 'string', 'max:255'],
            'attribute_id' => ['required', 'exists:attributes,id'],
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
        return $this->null;
    }
}
