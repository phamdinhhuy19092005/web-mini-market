<?php

namespace App\Http\Requests;

use App\Enum\ActivationStatus;
use App\Http\Requests\Interfaces\UpdateFaqRequestInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFaqRequest extends FormRequest implements UpdateFaqRequestInterface
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
