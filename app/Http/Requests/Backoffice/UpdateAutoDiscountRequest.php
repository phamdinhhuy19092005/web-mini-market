<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\DiscountConditionTypeEnum;
use App\Enum\DiscountTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\UpdateAutoDiscountRequestInterface;
use Illuminate\Validation\Rule;

class UpdateAutoDiscountRequest extends BaseFormRequest implements UpdateAutoDiscountRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('auto_discounts', 'code')->ignore($this->route('id'))],
            'discount_type' => ['required', 'integer', Rule::in(DiscountTypeEnum::values())],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'condition_type' => ['required', Rule::in(DiscountConditionTypeEnum::values())],
            'condition_value' => ['required', 'string', 'max:255'],
            'usage_limit' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:1000'],
            'terms' => ['nullable', 'string'],
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
