<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\PaymentOptionTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\UpdatePaymentOptionRequestInterface;
use Illuminate\Validation\Rule;

class UpdatePaymentOptionRequest extends BaseFormRequest implements UpdatePaymentOptionRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'payment_provider_id' => ['nullable', 'exists:payment_providers,id'],
            'logo' => ['nullable', 'array'],
            'logo.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'logo.path' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'currency_code' => ['required', 'string', 'max:50'],
            'min_amount' => ['nullable', 'numeric', 'min:0'],
            'max_amount' => ['nullable', 'numeric', 'min:0'],
            'payment_type' => ['required', Rule::in(PaymentOptionTypeEnum::all())],     
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'display_on_frontend' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    public function imageFile()
    {
        return $this->file('logo.file');
    }

}
