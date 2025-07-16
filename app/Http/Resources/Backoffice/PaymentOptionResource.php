<?php

namespace App\Http\Resources\Backoffice;;

class PaymentOptionResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge([
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'type' => $this->type,
            'payment_provider_id' => $this->payment_provider_id,
            'currency_code' => $this->currency_code,
            'order' => $this->order,
            'status_name' => $this->status_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ], $this->generateActionPermissions());
    }

    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.payment-options.edit', $this->id),
            ]),
        ]);
    }
}
