<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name'           => 'Vietnam',
            'iso3'           => 'VNM',
            'numeric'        => '704',
            'iso2'           => 'VN',
            'phonecode'      => '84',
            'capital'        => 'Hanoi',
            'currency'       => 'VND',
            'currency_name'  => 'Vietnamese đồng',
            'tld'            => '.vn',
            'native'         => 'Việt Nam',
            'region'         => 'Asia',
            'subregion'      => 'South-Eastern Asia',
            'timezones'      => json_encode([
                [
                    'tzName'         => 'Indochina Time',
                    'zoneName'       => 'Asia/Ho_Chi_Minh',
                    'gmtOffset'      => 25200,
                    'abbreviation'   => 'ICT',
                    'gmtOffsetName'  => 'UTC+07:00',
                ]
            ]),
            'translations'   => json_encode([
                "br" => "Vietnã",
                "cn" => "越南",
                "de" => "Vietnam",
                "es" => "Vietnam",
                "fa" => "ویتنام",
                "fr" => "Viêt Nam",
                "hr" => "Vijetnam",
                "it" => "Vietnam",
                "ja" => "ベトナム",
                "kr" => "베트남",
                "nl" => "Vietnam",
                "pt" => "Vietname"
            ]),
            'latitude'       => 16.16666666,
            'longitude'      => 107.83333333,
            'emoji'          => '🇻🇳',
            'emojiU'         => 'U+1F1FB U+1F1F3',
            'status'         => true,
            'flag'           => 1,
            'wikiDataId'     => 'Q881',
        ]);
    }
}
