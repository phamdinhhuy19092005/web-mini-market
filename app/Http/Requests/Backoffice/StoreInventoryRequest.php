<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\InventoryConditionEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreInventoryRequestInterface;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class StoreInventoryRequest extends BaseFormRequest implements StoreInventoryRequestInterface
{
    public function rules(): array
    {

        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:inventories,slug,' . ($this->inventory->id ?? 'NULL')],
            'sku' => ['required', 'string', 'max:50', 'unique:inventories,sku,' . ($this->inventory->id ?? 'NULL')],
            'condition' => ['required', Rule::in(InventoryConditionEnum::all())],
            'unit' => ['nullable', 'string', 'max:50'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
            'quantity_in_unit' => ['nullable', 'integer', 'min:1'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'purchase_price' => ['nullable', 'numeric', 'min:0'],
            'sale_price' => ['required', 'numeric', 'min:0'],
            'offer_price' => ['nullable', 'numeric', 'min:0', 'lte:sale_price'],
            'available_from' => ['nullable', 'date'],
            'min_order_quantity' => ['nullable', 'integer', 'min:1'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'init_sold_count' => ['nullable', 'integer', 'min:0'],
            'offer_start' => ['nullable', 'date', 'required_with:offer_price'],
            'offer_end' => ['nullable', 'date', 'after_or_equal:offer_start', 'required_with:offer_price'],
            'condition_note' => ['nullable', 'string'],
            'key_features.*.title' => ['nullable', 'string', 'max:255'],
            'meta' => ['nullable', 'json'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'display_on_frontend' => ['boolean'],
            'allow_frontend_search' => ['boolean'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'image.path' => ['nullable', 'string', 'max:255'],
            'image.file' => ['nullable', 'image', 'max:2048'],
            'attribute_values.*' => ['nullable', 'exists:attribute_values,id'],
            'description' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,
            'display_on_frontend' => filter_var($this->display_on_frontend, FILTER_VALIDATE_BOOLEAN),
            'allow_frontend_search' => filter_var($this->allow_frontend_search, FILTER_VALIDATE_BOOLEAN),
            'display_on_frontend' => filter_var($this->display_on_frontend, FILTER_VALIDATE_BOOLEAN),
            'allow_frontend_search' => filter_var($this->allow_frontend_search, FILTER_VALIDATE_BOOLEAN),
            'meta_keywords' => is_array($this->meta_keywords) ? implode(',', $this->meta_keywords) : $this->meta_keywords,
        ]);
    }

    public function imageFile()
    {
        return $this->file('image.file');
    }
}
