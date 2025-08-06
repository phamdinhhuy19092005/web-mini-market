<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\PaymentTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StorePaymentProviderRequestInterface;
use Illuminate\Validation\Rule;

class StorePaymentProviderRequest extends BaseFormRequest implements StorePaymentProviderRequestInterface
{
    public function rules(): array
    {
        dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string'],
            'payment_type' => ['required', 'integer', Rule::in(array_keys(PaymentTypeEnum::labels()))],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'params' => ['required', 'array'],
        ];
    }

    public function imageFile()
    {
        return null;
    }
}
