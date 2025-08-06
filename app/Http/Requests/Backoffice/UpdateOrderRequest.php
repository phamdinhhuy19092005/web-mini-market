<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\ActivationFE;
use App\Http\Requests\Backoffice\Interfaces\UpdateOrderRequestInterface;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends BaseFormRequest implements UpdateOrderRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],

            'display_in' => ['required', 'array'],
            'display_in.*' => ['string', Rule::in(\App\Enum\PageDisplayInEnum::all())],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],

            'display_on_frontend' => ['required', Rule::in(ActivationFE::all())],
            'status' => ['required', Rule::in(ActivationStatus::all())],

            'content' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,

            'display_on_frontend' => filter_var($this->display_on_frontend, FILTER_VALIDATE_BOOLEAN)
                ? ActivationFE::ACTIVE
                : ActivationFE::INACTIVE,
        ]);
    }


    public function imageFile()
    {
        return null;
    }
}
