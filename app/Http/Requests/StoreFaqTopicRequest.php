<?php

namespace App\Http\Requests;

use App\Enum\ActivationStatus;
use App\Http\Requests\Interfaces\StoreFaqTopicRequestInterface;
use Illuminate\Validation\Rule;

class StoreFaqTopicRequest extends BaseFormRequest implements StoreFaqTopicRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
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
