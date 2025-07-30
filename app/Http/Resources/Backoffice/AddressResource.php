<?php

namespace App\Http\Resources\Backoffice;;

class AddressResource extends BaseResource
{
    public function toArray($request): array
    {
        return array_merge(
            [
                'id' => $this->id,
                'user' => [
                    'id' => $this->user_id,
                    'actions' => [
                        'show' => route('bo.web.users.show', $this->user_id),
                    ],
                ],
                'name' => $this->name,
                'phone' => $this->phone,
                'address_line' => $this->address_line,

                'province' => [
                    'code' => $this->province_code,
                    'name' => optional($this->province)->name,
                ],
                'district' => [
                    'code' => $this->district_code,
                    'name' => optional($this->district)->name,
                ],
                'ward' => [
                    'code' => $this->ward_code,
                    'name' => optional($this->ward)->name,
                ],

                'is_default' => $this->is_default ? 'Default' : 'Normal',
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            $this->generateActionPermissions()
        );
    }


    public function generateActionPermissions() : array
    {
        return array_filter([
            'actions' => array_filter([
                'update' => route('bo.web.addresses.show', $this->id),
            ]),
        ]);
    }
}
