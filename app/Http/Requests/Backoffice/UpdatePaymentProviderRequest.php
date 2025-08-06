<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\PaymentTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\UpdatePaymentProviderRequestInterface;
use Illuminate\Validation\Rule;

class UpdatePaymentProviderRequest extends BaseFormRequest implements UpdatePaymentProviderRequestInterface
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string'],
            'payment_type' => ['required', 'integer', Rule::in(array_keys(PaymentTypeEnum::labels()))],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'params' => ['required', 'array'],  
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->params)) {
            $decoded = json_decode($this->params, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->merge([
                    'params' => $decoded,
                ]);
            }
        }
    }

    public function imageFile()
    {
        return null;
    }

}
