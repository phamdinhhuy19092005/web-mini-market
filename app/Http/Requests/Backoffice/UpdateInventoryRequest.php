<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Enum\InventoryConditionEnum;
use App\Http\Requests\Backoffice\Interfaces\UpdateInventoryRequestInterface;
use Illuminate\Validation\Rule;

class UpdateInventoryRequest extends BaseFormRequest implements UpdateInventoryRequestInterface
{
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('inventories', 'slug')->ignore($this->route('id'))],
            'sku' => ['required', 'string', 'max:50', Rule::unique('inventories', 'sku')->ignore($this->route('id'))],
            'condition' => ['required', Rule::in(InventoryConditionEnum::all())],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'purchase_price' => ['nullable', 'numeric', 'min:0'],
            'sale_price' => ['required', 'numeric', 'min:0'],
            'offer_price' => ['nullable', 'numeric', 'min:0', 'lte:sale_price'],
            'offer_start' => ['nullable', 'date', Rule::requiredIf(fn () => filled($this->offer_price))],
            'offer_end' => ['nullable', 'date', 'after_or_equal:offer_start', Rule::requiredIf(fn () => floatval($this->offer_price) > 0)],
            'available_from' => ['nullable', 'date'],
            'min_order_quantity' => ['nullable', 'integer', 'min:1'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'init_sold_count' => ['nullable', 'integer', 'min:0'],
            'condition_note' => ['nullable', 'string'],
            'key_features.*.title' => ['nullable', 'string', 'max:255'],
            'meta' => ['nullable', 'json'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'display_on_frontend' => ['nullable', 'boolean'],
            'allow_frontend_search' => ['nullable', 'boolean'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'image.path' => ['nullable', 'string', 'max:255'],
            'image.file' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'offer_price' => $this->offer_price === '' ? null : $this->offer_price,
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN) ? ActivationStatus::ACTIVE : ActivationStatus::INACTIVE,
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
