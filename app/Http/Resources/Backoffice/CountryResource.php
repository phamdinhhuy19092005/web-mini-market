<?php

namespace App\Http\Resources\Backoffice;;

class CountryResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'iso3'           => $this->iso3,
            'numeric'        => $this->numeric,
            'iso2'           => $this->iso2,
            'phonecode'      => $this->phonecode,
            'capital'        => $this->capital,
            'currency'       => $this->currency,
            'currency_name'  => $this->currency_name,
            'tld'            => $this->tld,
            'native'         => $this->native,
            'region'         => $this->region,
            'subregion'      => $this->subregion,
            'timezones'      => $this->timezones,
            'translations'   => $this->translations,
            'latitude'       => $this->latitude,
            'longitude'      => $this->longitude,
            'emoji'          => $this->emoji,
            'emojiU'         => $this->emojiU,
            'status'         => $this->status,
            'flag'           => $this->flag,
            'wikiDataId'     => $this->wikiDataId,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
