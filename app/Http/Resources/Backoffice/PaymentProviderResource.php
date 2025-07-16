<?php

namespace App\Http\Resources\Backoffice;;

class PaymentProviderResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge([
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'payment_type' => $this->payment_type,
            'payment_type_name' => $this->payment_type_name,
            'status_name' => $this->status_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ], $this->generateActionPermissions());
    }

    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.payment-providers.edit', $this->id),
            ]),
        ]);
    }
}
