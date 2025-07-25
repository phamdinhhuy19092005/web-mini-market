<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\UpdateShippingZoneRequestInterface;
use Illuminate\Validation\Rule;

class UpdateShippingZoneRequest extends BaseFormRequest implements UpdateShippingZoneRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
             'name' => 'required|string|max:255',
            'supported_countries' => 'required|array|min:1',
            'supported_countries.*' => 'exists:countries,iso2',
            'supported_provinces' => 'required|array|min:1',
            'supported_provinces.*' => 'exists:provinces,code',
            'supported_districts' => 'nullable|array',
            'supported_districts.*' => 'exists:districts,code',
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,
        ]);
    }

    
    public function imageFile()
    {
        return null;
    }
}
