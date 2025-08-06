<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\AccessChannelOptions;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\ShippingOption;
use App\Models\PaymentOption;
use Illuminate\Validation\Rule;
use App\Http\Requests\Backoffice\Interfaces\StoreOrderRequestInterface;

class StoreOrderRequest extends BaseFormRequest implements StoreOrderRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());    
        return [
            'user_id' => ['required', Rule::exists(User::class, 'id')],
            'cart_items' => ['required', 'array'],
            'cart_items.*.inventory_id' => ['required', 'int', Rule::exists(Inventory::class, 'id')],
            'cart_items.*.quantity' => ['required', 'int', 'gt:0'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'phone' => 'required|string',
            'company' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:255'],
            'province_code' => ['required', Rule::in(Province::make()->all()->pluck('code'))],
            'district_code' => ['required', Rule::in(District::make()->all()->pluck('code'))],
            'ward_code' => ['required', Rule::in(Ward::make()->all()->pluck('code'))],
            'shipping_option_id' => ['required', Rule::exists(ShippingOption::class, 'id')],
            'shipping_rate_id' => ['nullable', 'integer'],
            'payment_option_id' => ['required', Rule::exists(PaymentOption::class, 'id')],
            'order_channel' => ['required', 'array'],
            'order_channel.type' => ['required', Rule::in(AccessChannelOptions::all())],
            'order_channel.reference_id' => ['nullable', 'string'],
            'total_price' => ['required', 'numeric', 'gte:0'],
        ];
    }

    public function prepareForValidation()
    {
        $validatedData = $this->all();
        data_set($validatedData, 'order_channel.type', (int) data_get($validatedData, 'order_channel.type'));
        $this->merge($validatedData);
    }

    public function imageFile()
    {
        return null;
    }
}