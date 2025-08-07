<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreCartRequestInterface;

class StoreCartRequest extends BaseFormRequest implements StoreCartRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'user_id' => ['required', 'exists:users,id'],
            'address_id' => ['nullable', 'integer', 'min:1'],
            'currency_code' => ['required', 'in:VND,USD,EUR'],
            'order_id' => ['nullable', 'integer'],
            'retry_times' => ['nullable', 'integer', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.inventory_id' => ['required', 'exists:inventories,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'total_quantity' => ['required', 'integer', 'min:1'],
            'total_price' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $items = $this->input('items', []);
        $filteredItems = array_filter($items, function ($item, $key) {
            return $key !== '__INDEX__' && !empty($item['inventory_id']) && !empty($item['price']);
        }, ARRAY_FILTER_USE_BOTH);

        $this->merge([
            'items' => array_values($filteredItems),
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN) ? ActivationStatus::ACTIVE : ActivationStatus::INACTIVE,
        ]);
    }

    public function imageFile()
    {
        return null;
    }
}
