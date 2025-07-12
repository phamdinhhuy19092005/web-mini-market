<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationFE;
use App\Enum\ActivationStatus;
use App\Enum\ShippingRateTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreShippingRateRequestInterface;
use Illuminate\Validation\Rule;

class StoreShippingRateRequest extends BaseFormRequest implements StoreShippingRateRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [

            'name' => ['required', 'string', 'max:255'],
            'shipping_zone_id' => ['required', 'integer', Rule::exists('shipping_zones', 'id')],
            'delivery_takes' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(array_keys(ShippingRateTypeEnum::labels()))],
            'minimum' => ['required', 'numeric', 'min:0'],
            'maximum' => ['nullable', 'numeric', 'min:0', 'gte:minimum'],
            'rate' => ['required', 'numeric', 'min:0'],
            'display_on_frontend' => ['required', Rule::in(ActivationFE::all())],
            'status' => ['required', Rule::in(ActivationStatus::all())],
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
