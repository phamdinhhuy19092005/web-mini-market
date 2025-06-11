<?php

namespace App\Http\Requests;

use App\Enum\ActivationStatus;
use App\Http\Requests\Interfaces\StoreFaqRequestInterface;
use Illuminate\Validation\Rule;

class StoreFaqRequest extends BaseFormRequest implements StoreFaqRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order' => ['nullable', 'integer'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'faq_topic_id' => ['required', 'integer', 'exists:faq_topics,id'],
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
