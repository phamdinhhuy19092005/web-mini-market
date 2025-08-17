<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\ActivationFE;
use App\Enum\OrderStatusEnum;
use App\Http\Requests\Backoffice\Interfaces\UpdateOrderRequestInterface;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends BaseFormRequest implements UpdateOrderRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'company' => ['nullable', 'string', 'max:255'],
            'province_code' => ['required', 'string', 'max:10'],
            'district_code' => ['required', 'string', 'max:10'],
            'ward_code' => ['required', 'string', 'max:10'],
            'address_line' => ['required', 'string', 'max:255'],

            'shipping_rate_id' => ['nullable', 'integer', 'exists:shipping_rates,id'],
            'payment_option_id' => ['nullable', 'integer', 'exists:payment_options,id'],

            'user_note' => ['nullable', 'string'],
            'admin_note' => ['nullable', 'string'],

            'cart_items' => ['nullable', 'array'],
            'cart_items.*.inventory_id' => ['required', 'integer', 'exists:inventories,id'],
            'cart_items.*.quantity' => ['required', 'integer', 'min:1'],

            'order_status' => ['required', Rule::in(OrderStatusEnum::all())],
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
