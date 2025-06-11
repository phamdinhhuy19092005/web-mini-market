<?php

namespace App\Http\Resources;

class CurrencyResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'type'           => $this->type,
            'name'           => $this->name,
            'code'           => $this->code,
            'symbol'         => $this->symbol,
            'decimals'       => $this->decimals,
            'status'         => $this->status,
            'used_countries' => $this->used_countries,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
