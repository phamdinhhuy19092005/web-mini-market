<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreCartRequestInterface;


class StoreCartRequest extends BaseFormRequest implements StoreCartRequestInterface
{
    public function rules(): array
    {
        dd($this->all());
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:inventories,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN) ? ActivationStatus::ACTIVE : ActivationStatus::INACTIVE,
        ]);
    }
    
    public function imageFile()
    {
        return null;
    }
}
