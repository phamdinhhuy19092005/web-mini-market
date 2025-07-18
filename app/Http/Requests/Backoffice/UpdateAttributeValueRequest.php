<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\UpdateAttributeValueRequestInterface;
use Illuminate\Validation\Rule;

class UpdateAttributeValueRequest extends BaseFormRequest implements UpdateAttributeValueRequestInterface
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
        return null;
    }
}
