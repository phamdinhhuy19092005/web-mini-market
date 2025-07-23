<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\DiscountTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\UpdateCouponRequestInterface;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends BaseFormRequest implements UpdateCouponRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('coupons', 'code')->ignore($this->route('id'))],
            'discount_type' => ['required', 'integer', Rule::in(DiscountTypeEnum::values())],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:0'],
            'terms' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
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
