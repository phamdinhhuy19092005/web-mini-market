<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::truncate();
        $currencies = [
            ['id' => 1,  'type' => 1, 'name' => 'Antarctican dollar',                   'code' => 'AAD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AQ']],
            ['id' => 2,  'type' => 1, 'name' => 'United Arab Emirates dirham',         'code' => 'AED', 'symbol' => 'إ.د', 'decimals' => 2, 'status' => 1, 'used_countries' => ['AE']],
            ['id' => 3,  'type' => 1, 'name' => 'Afghan afghani',                     'code' => 'AFN', 'symbol' => '؋',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AF']],
            ['id' => 4,  'type' => 1, 'name' => 'Albanian lek',                       'code' => 'ALL', 'symbol' => 'Lek', 'decimals' => 2, 'status' => 1, 'used_countries' => ['AL']],
            ['id' => 5,  'type' => 1, 'name' => 'Armenian dram',                      'code' => 'AMD', 'symbol' => '֏',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AM']],
            ['id' => 6,  'type' => 1, 'name' => 'Netherlands Antillean guilder',      'code' => 'ANG', 'symbol' => 'ƒ',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CW', 'SX']],
            ['id' => 7,  'type' => 1, 'name' => 'Angolan kwanza',                     'code' => 'AOA', 'symbol' => 'Kz',  'decimals' => 2, 'status' => 1, 'used_countries' => ['AO']],
            ['id' => 8,  'type' => 1, 'name' => 'Argentine peso',                     'code' => 'ARS', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AR']],
            ['id' => 9,  'type' => 1, 'name' => 'Australian dollar',                  'code' => 'AUD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AU', 'CX', 'CC', 'HM', 'KI', 'NR', 'NF', 'TV']],
            ['id' => 10, 'type' => 1, 'name' => 'Aruban florin',                      'code' => 'AWG', 'symbol' => 'ƒ',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AW']],
            ['id' => 11, 'type' => 1, 'name' => 'Azerbaijani manat',                  'code' => 'AZN', 'symbol' => '₼',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AZ']],
            ['id' => 12, 'type' => 1, 'name' => 'Bosnia and Herzegovina convertible mark', 'code' => 'BAM', 'symbol' => 'KM', 'decimals' => 2, 'status' => 1, 'used_countries' => ['BA']],
            ['id' => 13, 'type' => 1, 'name' => 'Barbadian dollar',                   'code' => 'BBD', 'symbol' => 'Bds$','decimals' => 2, 'status' => 1, 'used_countries' => ['BB']],
            ['id' => 14, 'type' => 1, 'name' => 'Bangladeshi taka',                   'code' => 'BDT', 'symbol' => '৳',   'decimals' => 2, 'status' => 1, 'used_countries' => ['BD']],
            ['id' => 15, 'type' => 1, 'name' => 'Bulgarian lev',                     'code' => 'BGN', 'symbol' => 'лв.', 'decimals' => 2, 'status' => 1, 'used_countries' => ['BG']],
            ['id' => 16, 'type' => 1, 'name' => 'Bahraini dinar',                    'code' => 'BHD', 'symbol' => 'د.ب.','decimals' => 3, 'status' => 1, 'used_countries' => ['BH']],
            ['id' => 17, 'type' => 1, 'name' => 'Burundian franc',                   'code' => 'BIF', 'symbol' => 'FBu', 'decimals' => 2, 'status' => 1, 'used_countries' => ['BI']],
            ['id' => 18, 'type' => 1, 'name' => 'Bermudian dollar',                  'code' => 'BMD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['BM']],
            ['id' => 19, 'type' => 1, 'name' => 'Brunei dollar',                     'code' => 'BND', 'symbol' => 'B$',  'decimals' => 2, 'status' => 1, 'used_countries' => ['BN']],
            ['id' => 20, 'type' => 1, 'name' => 'Bolivian boliviano',                'code' => 'BOB', 'symbol' => 'Bs.', 'decimals' => 2, 'status' => 1, 'used_countries' => ['BO']],
            ['id' => 21, 'type' => 1, 'name' => 'Brazilian real',                    'code' => 'BRL', 'symbol' => 'R$',  'decimals' => 2, 'status' => 1, 'used_countries' => ['BR']],
            ['id' => 22, 'type' => 1, 'name' => 'Bahamian dollar',                   'code' => 'BSD', 'symbol' => 'B$',  'decimals' => 2, 'status' => 1, 'used_countries' => ['BS']],
            ['id' => 23, 'type' => 1, 'name' => 'Bhutanese ngultrum',                'code' => 'BTN', 'symbol' => 'Nu.', 'decimals' => 2, 'status' => 1, 'used_countries' => ['BT']],
            ['id' => 24, 'type' => 1, 'name' => 'Botswana pula',                     'code' => 'BWP', 'symbol' => 'P',   'decimals' => 2, 'status' => 1, 'used_countries' => ['BW']],
            ['id' => 25, 'type' => 1, 'name' => 'Belarusian ruble',                  'code' => 'BYN', 'symbol' => 'Br',  'decimals' => 2, 'status' => 1, 'used_countries' => ['BY']],
            ['id' => 26, 'type' => 1, 'name' => 'Belize dollar',                     'code' => 'BZD', 'symbol' => 'BZ$', 'decimals' => 2, 'status' => 1, 'used_countries' => ['BZ']],
            ['id' => 27, 'type' => 1, 'name' => 'Canadian dollar',                   'code' => 'CAD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CA']],
            ['id' => 28, 'type' => 1, 'name' => 'Congolese Franc',                   'code' => 'CDF', 'symbol' => 'FC',  'decimals' => 2, 'status' => 1, 'used_countries' => ['CD']],
            ['id' => 29, 'type' => 1, 'name' => 'Swiss franc',                      'code' => 'CHF', 'symbol' => 'CHF', 'decimals' => 2, 'status' => 1, 'used_countries' => ['LI', 'CH']],
            ['id' => 30, 'type' => 1, 'name' => 'Chilean peso',                      'code' => 'CLP', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CL']],
            ['id' => 31, 'type' => 1, 'name' => 'Chinese yuan',                      'code' => 'CNY', 'symbol' => '¥',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CN']],
            ['id' => 32, 'type' => 1, 'name' => 'Colombian peso',                    'code' => 'COP', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CO']],
            ['id' => 33, 'type' => 1, 'name' => 'Costa Rican colón',                 'code' => 'CRC', 'symbol' => '₡',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CR']],
            ['id' => 34, 'type' => 1, 'name' => 'Cuban peso',                        'code' => 'CUP', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CU']],
            ['id' => 35, 'type' => 1, 'name' => 'Cape Verdean escudo',               'code' => 'CVE', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CV']],
            ['id' => 36, 'type' => 1, 'name' => 'Czech koruna',                      'code' => 'CZK', 'symbol' => 'Kč',  'decimals' => 2, 'status' => 1, 'used_countries' => ['CZ']],
            ['id' => 37, 'type' => 1, 'name' => 'Djiboutian franc',                  'code' => 'DJF', 'symbol' => 'Fdj', 'decimals' => 2, 'status' => 1, 'used_countries' => ['DJ']],
            ['id' => 38, 'type' => 1, 'name' => 'Danish krone',                      'code' => 'DKK', 'symbol' => 'Kr.', 'decimals' => 2, 'status' => 1, 'used_countries' => ['DK', 'FO', 'GL']],
            ['id' => 39, 'type' => 1, 'name' => 'Dominican peso',                    'code' => 'DOP', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['DO']],
            ['id' => 40, 'type' => 1, 'name' => 'Algerian dinar',                    'code' => 'DZD', 'symbol' => 'دج',  'decimals' => 2, 'status' => 1, 'used_countries' => ['DZ']],
            ['id' => 41, 'type' => 1, 'name' => 'Egyptian pound',                    'code' => 'EGP', 'symbol' => '£-ج.م', 'decimals' => 2, 'status' => 1, 'used_countries' => ['EG']],
            ['id' => 42, 'type' => 1, 'name' => 'Eritrean nakfa',                    'code' => 'ERN', 'symbol' => 'Nfk', 'decimals' => 2, 'status' => 1, 'used_countries' => ['ER']],
            ['id' => 43, 'type' => 1, 'name' => 'Ethiopian birr',                    'code' => 'ETB', 'symbol' => 'Nkf', 'decimals' => 2, 'status' => 1, 'used_countries' => ['ET']],
            ['id' => 44, 'type' => 1, 'name' => 'Euro',                              'code' => 'EUR', 'symbol' => '€',   'decimals' => 2, 'status' => 1, 'used_countries' => ['LV', 'LT', 'LU', 'MT', 'MQ', 'YT', 'MC', 'ME', 'NL', 'PT', 'RE', 'PM', 'BL', 'MF', 'SM', 'SK', 'SI', 'ES', 'VA', 'XK']],
            ['id' => 45, 'type' => 1, 'name' => 'Fijian dollar',                     'code' => 'FJD', 'symbol' => 'FJ$', 'decimals' => 2, 'status' => 1, 'used_countries' => ['FJ']],
            ['id' => 46, 'type' => 1, 'name' => 'Falkland Islands pound',            'code' => 'FKP', 'symbol' => '£',   'decimals' => 2, 'status' => 1, 'used_countries' => ['FK']],
            ['id' => 47, 'type' => 1, 'name' => 'British pound',                     'code' => 'GBP', 'symbol' => '£',   'decimals' => 2, 'status' => 1, 'used_countries' => ['GG', 'JE', 'IM', 'GS', 'GB']],
            ['id' => 48, 'type' => 1, 'name' => 'Georgian lari',                     'code' => 'GEL', 'symbol' => '₾',   'decimals' => 2, 'status' => 1, 'used_countries' => ['GE']],
            ['id' => 49, 'type' => 1, 'name' => 'Ghanaian cedi',                    'code' => 'GHS', 'symbol' => 'GH₵', 'decimals' => 2, 'status' => 1, 'used_countries' => ['GH']],
            ['id' => 50, 'type' => 1, 'name' => 'Gibraltar pound',                   'code' => 'GIP', 'symbol' => '£',   'decimals' => 2, 'status' => 1, 'used_countries' => ['GI']],
            ['id' => 51, 'type' => 1, 'name' => 'Gambian dalasi',                   'code' => 'GMD', 'symbol' => 'D',   'decimals' => 2, 'status' => 1, 'used_countries' => ['GM']],
            ['id' => 52, 'type' => 1, 'name' => 'Guinean franc',                    'code' => 'GNF', 'symbol' => 'FG',  'decimals' => 0, 'status' => 1, 'used_countries' => ['GN']],
            ['id' => 53, 'type' => 1, 'name' => 'Guatemalan quetzal',                'code' => 'GTQ', 'symbol' => 'Q',   'decimals' => 2, 'status' => 1, 'used_countries' => ['GT']],
            ['id' => 54, 'type' => 1, 'name' => 'Guyanese dollar',                   'code' => 'GYD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['GY']],
            ['id' => 55, 'type' => 1, 'name' => 'Hong Kong dollar',                  'code' => 'HKD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['HK']],
            ['id' => 56, 'type' => 1, 'name' => 'Honduran lempira',                 'code' => 'HNL', 'symbol' => 'L',   'decimals' => 2, 'status' => 1, 'used_countries' => ['HN']],
            ['id' => 57, 'type' => 1, 'name' => 'Croatian kuna',                     'code' => 'HRK', 'symbol' => 'kn',  'decimals' => 2, 'status' => 1, 'used_countries' => ['HR']],
            ['id' => 58, 'type' => 1, 'name' => 'Haitian gourde',                   'code' => 'HTG', 'symbol' => 'G',   'decimals' => 2, 'status' => 1, 'used_countries' => ['HT']],
            ['id' => 59, 'type' => 1, 'name' => 'Hungarian forint',                  'code' => 'HUF', 'symbol' => 'Ft',  'decimals' => 2, 'status' => 1, 'used_countries' => ['HU']],
            ['id' => 60, 'type' => 1, 'name' => 'Indonesian rupiah',                 'code' => 'IDR', 'symbol' => 'Rp',  'decimals' => 2, 'status' => 1, 'used_countries' => ['ID']],
            ['id' => 61, 'type' => 1, 'name' => 'Israeli new shekel',                'code' => 'ILS', 'symbol' => '₪',   'decimals' => 2, 'status' => 1, 'used_countries' => ['IL', 'PS']],
            ['id' => 62, 'type' => 1, 'name' => 'Indian rupee',                     'code' => 'INR', 'symbol' => '₹',   'decimals' => 2, 'status' => 1, 'used_countries' => ['IN']],
            ['id' => 63, 'type' => 1, 'name' => 'Iraqi dinar',                      'code' => 'IQD', 'symbol' => 'ع.د', 'decimals' => 3, 'status' => 1, 'used_countries' => ['IQ']],
            ['id' => 64, 'type' => 1, 'name' => 'Iranian rial',                     'code' => 'IRR', 'symbol' => '﷼',   'decimals' => 2, 'status' => 1, 'used_countries' => ['IR']],
            ['id' => 65, 'type' => 1, 'name' => 'Icelandic króna',                  'code' => 'ISK', 'symbol' => 'kr',  'decimals' => 0, 'status' => 1, 'used_countries' => ['IS']],
            ['id' => 66, 'type' => 1, 'name' => 'Jamaican dollar',                  'code' => 'JMD', 'symbol' => 'J$',  'decimals' => 2, 'status' => 1, 'used_countries' => ['JM']],
            ['id' => 67, 'type' => 1, 'name' => 'Jordanian dinar',                  'code' => 'JOD', 'symbol' => 'د.ا', 'decimals' => 3, 'status' => 1, 'used_countries' => ['JO']],
            ['id' => 68, 'type' => 1, 'name' => 'Japanese yen',                     'code' => 'JPY', 'symbol' => '¥',   'decimals' => 0, 'status' => 1, 'used_countries' => ['JP']],
            ['id' => 69, 'type' => 1, 'name' => 'Kenyan shilling',                  'code' => 'KES', 'symbol' => 'KSh', 'decimals' => 2, 'status' => 1, 'used_countries' => ['KE']],
            ['id' => 70, 'type' => 1, 'name' => 'Kyrgyzstani som',                  'code' => 'KGS', 'symbol' => 'лв',  'decimals' => 2, 'status' => 1, 'used_countries' => ['KG']],
            ['id' => 71, 'type' => 1, 'name' => 'Cambodian riel',                   'code' => 'KHR', 'symbol' => 'KHR', 'decimals' => 2, 'status' => 1, 'used_countries' => ['KH']],
            ['id' => 72, 'type' => 1, 'name' => 'Comorian franc',                   'code' => 'KMF', 'symbol' => 'CF',  'decimals' => 0, 'status' => 1, 'used_countries' => ['KM']],
            ['id' => 73, 'type' => 1, 'name' => 'North Korean Won',                 'code' => 'KPW', 'symbol' => '₩',   'decimals' => 2, 'status' => 1, 'used_countries' => ['KP']],
            ['id' => 74, 'type' => 1, 'name' => 'Won',                              'code' => 'KRW', 'symbol' => '₩',   'decimals' => 0, 'status' => 1, 'used_countries' => ['KR']],
            ['id' => 75, 'type' => 1, 'name' => 'Kuwaiti dinar',                    'code' => 'KWD', 'symbol' => 'د.ك', 'decimals' => 3, 'status' => 1, 'used_countries' => ['KW']],
            ['id' => 76, 'type' => 1, 'name' => 'Cayman Islands dollar',             'code' => 'KYD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['KY']],
            ['id' => 77, 'type' => 1, 'name' => 'Kazakhstani tenge',                'code' => 'KZT', 'symbol' => 'лв',  'decimals' => 2, 'status' => 1, 'used_countries' => ['KZ']],
            ['id' => 78, 'type' => 1, 'name' => 'Lao kip',                          'code' => 'LAK', 'symbol' => '₭',   'decimals' => 2, 'status' => 1, 'used_countries' => ['LA']],
            ['id' => 79, 'type' => 1, 'name' => 'Lebanese pound',                   'code' => 'LBP', 'symbol' => '£',   'decimals' => 2, 'status' => 1, 'used_countries' => ['LB']],
            ['id' => 80, 'type' => 1, 'name' => 'Sri Lankan rupee',                 'code' => 'LKR', 'symbol' => 'Rs',  'decimals' => 2, 'status' => 1, 'used_countries' => ['LK']],
            ['id' => 81, 'type' => 1, 'name' => 'Liberian dollar',                  'code' => 'LRD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['LR']],
            ['id' => 82, 'type' => 1, 'name' => 'Lesotho loti',                     'code' => 'LSL', 'symbol' => 'L',   'decimals' => 2, 'status' => 1, 'used_countries' => ['LS']],
            ['id' => 83, 'type' => 1, 'name' => 'Libyan dinar',                     'code' => 'LYD', 'symbol' => 'ل.د', 'decimals' => 2, 'status' => 1, 'used_countries' => ['LY']],
            ['id' => 84, 'type' => 1, 'name' => 'Moroccan dirham',                  'code' => 'MAD', 'symbol' => 'DH',  'decimals' => 2, 'status' => 1, 'used_countries' => ['MA', 'EH']],
            ['id' => 85, 'type' => 1, 'name' => 'Moldovan leu',                     'code' => 'MDL', 'symbol' => 'L',   'decimals' => 2, 'status' => 1, 'used_countries' => ['MD']],
            ['id' => 86, 'type' => 1, 'name' => 'Malagasy ariary',                  'code' => 'MGA', 'symbol' => 'Ar',  'decimals' => 2, 'status' => 1, 'used_countries' => ['MG']],
            ['id' => 87, 'type' => 1, 'name' => 'Denar',                            'code' => 'MKD', 'symbol' => 'ден', 'decimals' => 2, 'status' => 1, 'used_countries' => ['MK']],
            ['id' => 88, 'type' => 1, 'name' => 'Burmese kyat',                     'code' => 'MMK', 'symbol' => 'K',   'decimals' => 2, 'status' => 1, 'used_countries' => ['MM']],
            ['id' => 89, 'type' => 1, 'name' => 'Mongolian tögrög',                 'code' => 'MNT', 'symbol' => '₮',   'decimals' => 2, 'status' => 1, 'used_countries' => ['MN']],
            ['id' => 90, 'type' => 1, 'name' => 'Macanese pataca',                  'code' => 'MOP', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['MO']],
            ['id' => 91, 'type' => 1, 'name' => 'Mauritanian ouguiya',              'code' => 'MRO', 'symbol' => 'MRU', 'decimals' => 2, 'status' => 1, 'used_countries' => ['MR']],
            ['id' => 92, 'type' => 1, 'name' => 'Mauritian rupee',                  'code' => 'MUR', 'symbol' => 'Rs',  'decimals' => 2, 'status' => 1, 'used_countries' => ['MU']],
            ['id' => 93, 'type' => 1, 'name' => 'Maldivian rufiyaa',                'code' => 'MVR', 'symbol' => 'Rf',  'decimals' => 2, 'status' => 1, 'used_countries' => ['MV']],
            ['id' => 94, 'type' => 1, 'name' => 'Malawian kwacha',                  'code' => 'MWK', 'symbol' => 'MK',  'decimals' => 2, 'status' => 1, 'used_countries' => ['MW']],
            ['id' => 95, 'type' => 1, 'name' => 'Mexican peso',                     'code' => 'MXN', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['MX']],
            ['id' => 96, 'type' => 1, 'name' => 'Malaysian ringgit',                'code' => 'MYR', 'symbol' => 'RM',  'decimals' => 2, 'status' => 1, 'used_countries' => ['MY']],
            ['id' => 97, 'type' => 1, 'name' => 'Mozambican metical',               'code' => 'MZN', 'symbol' => 'MT',  'decimals' => 2, 'status' => 1, 'used_countries' => ['MZ']],
            ['id' => 98, 'type' => 1, 'name' => 'Namibian dollar',                  'code' => 'NAD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['NA']],
            ['id' => 99, 'type' => 1, 'name' => 'Nigerian naira',                   'code' => 'NGN', 'symbol' => '₦',   'decimals' => 2, 'status' => 1, 'used_countries' => ['NG']],
            ['id' => 100, 'type' => 1, 'name' => 'Nicaraguan córdoba',              'code' => 'NIO', 'symbol' => 'C$',  'decimals' => 2, 'status' => 1, 'used_countries' => ['NI']],
            ['id' => 101, 'type' => 1, 'name' => 'Norwegian Krone',                 'code' => 'NOK', 'symbol' => 'kr',  'decimals' => 2, 'status' => 1, 'used_countries' => ['BV', 'NO', 'SJ']],
            ['id' => 102, 'type' => 1, 'name' => 'Nepalese rupee',                  'code' => 'NPR', 'symbol' => 'Rs',  'decimals' => 2, 'status' => 1, 'used_countries' => ['NP']],
            ['id' => 103, 'type' => 1, 'name' => 'Cook Islands dollar',             'code' => 'NZD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['CK', 'NZ', 'NU', 'PN', 'TK']],
            ['id' => 104, 'type' => 1, 'name' => 'Omani rial',                      'code' => 'OMR', 'symbol' => 'ر.ع.', 'decimals' => 3, 'status' => 1, 'used_countries' => ['OM']],
            ['id' => 105, 'type' => 1, 'name' => 'Panamanian balboa',               'code' => 'PAB', 'symbol' => 'B/.', 'decimals' => 2, 'status' => 1, 'used_countries' => ['PA']],
            ['id' => 106, 'type' => 1, 'name' => 'Peruvian sol',                    'code' => 'PEN', 'symbol' => 'S/.', 'decimals' => 2, 'status' => 1, 'used_countries' => ['PE']],
            ['id' => 107, 'type' => 1, 'name' => 'Papua New Guinean kina',          'code' => 'PGK', 'symbol' => 'K',   'decimals' => 2, 'status' => 1, 'used_countries' => ['PG']],
            ['id' => 108, 'type' => 1, 'name' => 'Philippine peso',                 'code' => 'PHP', 'symbol' => '₱',   'decimals' => 2, 'status' => 1, 'used_countries' => ['PH']],
            ['id' => 109, 'type' => 1, 'name' => 'Pakistani rupee',                 'code' => 'PKR', 'symbol' => 'Rs',  'decimals' => 2, 'status' => 1, 'used_countries' => ['PK']],
            ['id' => 110, 'type' => 1, 'name' => 'Polish złoty',                    'code' => 'PLN', 'symbol' => 'zł',  'decimals' => 2, 'status' => 1, 'used_countries' => ['PL']],
            ['id' => 111, 'type' => 1, 'name' => 'Paraguayan guaraní',              'code' => 'PYG', 'symbol' => '₲',   'decimals' => 0, 'status' => 1, 'used_countries' => ['PY']],
            ['id' => 112, 'type' => 1, 'name' => 'Qatari riyal',                    'code' => 'QAR', 'symbol' => 'ر.ق', 'decimals' => 2, 'status' => 1, 'used_countries' => ['QA']],
            ['id' => 113, 'type' => 1, 'name' => 'Romanian leu',                    'code' => 'RON', 'symbol' => 'lei', 'decimals' => 2, 'status' => 1, 'used_countries' => ['RO']],
            ['id' => 114, 'type' => 1, 'name' => 'Serbian dinar',                   'code' => 'RSD', 'symbol' => 'din', 'decimals' => 2, 'status' => 1, 'used_countries' => ['RS']],
            ['id' => 115, 'type' => 1, 'name' => 'Russian ruble',                    'code' => 'RUB', 'symbol' => '₽',   'decimals' => 2, 'status' => 1, 'used_countries' => ['RU']],
            ['id' => 116, 'type' => 1, 'name' => 'Rwandan franc',                    'code' => 'RWF', 'symbol' => 'FRw', 'decimals' => 0, 'status' => 1, 'used_countries' => ['RW']],
            ['id' => 117, 'type' => 1, 'name' => 'Saudi riyal',                      'code' => 'SAR', 'symbol' => 'ر.س', 'decimals' => 2, 'status' => 1, 'used_countries' => ['SA']],
            ['id' => 118, 'type' => 1, 'name' => 'Solomon Islands dollar',           'code' => 'SBD', 'symbol' => 'SI$', 'decimals' => 2, 'status' => 1, 'used_countries' => ['SB']],
            ['id' => 119, 'type' => 1, 'name' => 'Seychellois rupee',                'code' => 'SCR', 'symbol' => 'SR',  'decimals' => 2, 'status' => 1, 'used_countries' => ['SC']],
            ['id' => 120, 'type' => 1, 'name' => 'Sudanese pound',                   'code' => 'SDG', 'symbol' => 'ج.س.', 'decimals' => 2, 'status' => 1, 'used_countries' => ['SD']],
            ['id' => 121, 'type' => 1, 'name' => 'Swedish krona',                    'code' => 'SEK', 'symbol' => 'kr',  'decimals' => 2, 'status' => 1, 'used_countries' => ['SE']],
            ['id' => 122, 'type' => 1, 'name' => 'Singapore dollar',                 'code' => 'SGD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['SG']],
            ['id' => 123, 'type' => 1, 'name' => 'Saint Helena pound',               'code' => 'SHP', 'symbol' => '£',   'decimals' => 2, 'status' => 1, 'used_countries' => ['SH']],
            ['id' => 124, 'type' => 1, 'name' => 'Sierra Leonean leone',             'code' => 'SLL', 'symbol' => 'Le',  'decimals' => 2, 'status' => 1, 'used_countries' => ['SL']],
            ['id' => 125, 'type' => 1, 'name' => 'Somali shilling',                  'code' => 'SOS', 'symbol' => 'Sh.so.', 'decimals' => 2, 'status' => 1, 'used_countries' => ['SO']],
            ['id' => 126, 'type' => 1, 'name' => 'Surinamese dollar',                'code' => 'SRD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['SR']],
            ['id' => 127, 'type' => 1, 'name' => 'South Sudanese pound',             'code' => 'SSP', 'symbol' => '£',   'decimals' => 2, 'status' => 1, 'used_countries' => ['SS']],
            ['id' => 128, 'type' => 1, 'name' => 'São Tomé and Príncipe dobra',      'code' => 'STD', 'symbol' => 'Db',  'decimals' => 2, 'status' => 1, 'used_countries' => ['ST']],
            ['id' => 129, 'type' => 1, 'name' => 'Syrian pound',                     'code' => 'SYP', 'symbol' => 'LS',  'decimals' => 2, 'status' => 1, 'used_countries' => ['SY']],
            ['id' => 130, 'type' => 1, 'name' => 'Lilangeni',                        'code' => 'SZL', 'symbol' => 'E',   'decimals' => 2, 'status' => 1, 'used_countries' => ['SZ']],
            ['id' => 131, 'type' => 1, 'name' => 'Thai baht',                        'code' => 'THB', 'symbol' => '฿',   'decimals' => 2, 'status' => 1, 'used_countries' => ['TH']],
            ['id' => 132, 'type' => 1, 'name' => 'Tajikistani somoni',               'code' => 'TJS', 'symbol' => 'SM',  'decimals' => 2, 'status' => 1, 'used_countries' => ['TJ']],
            ['id' => 133, 'type' => 1, 'name' => 'Turkmenistan manat',               'code' => 'TMT', 'symbol' => 'T',   'decimals' => 2, 'status' => 1, 'used_countries' => ['TM']],
            ['id' => 134, 'type' => 1, 'name' => 'Tunisian dinar',                   'code' => 'TND', 'symbol' => 'د.ت', 'decimals' => 3, 'status' => 1, 'used_countries' => ['TN']],
            ['id' => 135, 'type' => 1, 'name' => 'Tongan paʻanga',                   'code' => 'TOP', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['TO']],
            ['id' => 136, 'type' => 1, 'name' => 'Turkish lira',                     'code' => 'TRY', 'symbol' => '₺',   'decimals' => 2, 'status' => 1, 'used_countries' => ['TR']],
            ['id' => 137, 'type' => 1, 'name' => 'Trinidad and Tobago dollar',       'code' => 'TTD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['TT']],
            ['id' => 138, 'type' => 1, 'name' => 'New Taiwan dollar',                'code' => 'TWD', 'symbol' => 'NT$', 'decimals' => 2, 'status' => 1, 'used_countries' => ['TW']],
            ['id' => 139, 'type' => 1, 'name' => 'Tanzanian shilling',               'code' => 'TZS', 'symbol' => 'TSh', 'decimals' => 2, 'status' => 1, 'used_countries' => ['TZ']],
            ['id' => 140, 'type' => 1, 'name' => 'Ukrainian hryvnia',                'code' => 'UAH', 'symbol' => '₴',   'decimals' => 2, 'status' => 1, 'used_countries' => ['UA']],
            ['id' => 141, 'type' => 1, 'name' => 'Ugandan shilling',                 'code' => 'UGX', 'symbol' => 'USh', 'decimals' => 0, 'status' => 1, 'used_countries' => ['UG']],
            ['id' => 142, 'type' => 1, 'name' => 'US Dollar',                        'code' => 'USD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AS', 'IO', 'TL', 'EC', 'SV', 'GU', 'HT', 'FM', 'BQ', 'MP', 'PW', 'PR', 'TC', 'US', 'UM', 'VI']],
            ['id' => 143, 'type' => 1, 'name' => 'Uruguayan peso',                   'code' => 'UYU', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['UY']],
            ['id' => 144, 'type' => 1, 'name' => 'Uzbekistani soʻm',                 'code' => 'UZS', 'symbol' => 'soʻm', 'decimals' => 2, 'status' => 1, 'used_countries' => ['UZ']],
            ['id' => 145, 'type' => 1, 'name' => 'Bolívar',                          'code' => 'VEF', 'symbol' => 'Bs',  'decimals' => 2, 'status' => 1, 'used_countries' => ['VE']],
            ['id' => 146, 'type' => 1, 'name' => 'Vietnamese đồng',                  'code' => 'VND', 'symbol' => '₫',   'decimals' => 0, 'status' => 1, 'used_countries' => ['VN']],
            ['id' => 147, 'type' => 1, 'name' => 'Vanuatu vatu',                     'code' => 'VUV', 'symbol' => 'VT',  'decimals' => 0, 'status' => 1, 'used_countries' => ['VU']],
            ['id' => 148, 'type' => 1, 'name' => 'Samoan tālā',                      'code' => 'WST', 'symbol' => 'SAT', 'decimals' => 2, 'status' => 1, 'used_countries' => ['WS']],
            ['id' => 149, 'type' => 1, 'name' => 'Central African CFA franc',        'code' => 'XAF', 'symbol' => 'FCFA', 'decimals' => 0, 'status' => 1, 'used_countries' => ['CM', 'CF', 'TD', 'CG', 'GQ', 'GA']],
            ['id' => 150, 'type' => 1, 'name' => 'East Caribbean dollar',            'code' => 'XCD', 'symbol' => '$',   'decimals' => 2, 'status' => 1, 'used_countries' => ['AI', 'AG', 'DM', 'GD', 'MS', 'KN', 'LC', 'VC']],
            ['id' => 151, 'type' => 1, 'name' => 'West African CFA franc',           'code' => 'XOF', 'symbol' => 'CFA', 'decimals' => 0, 'status' => 1, 'used_countries' => ['BJ', 'BF', 'CI', 'GW', 'ML', 'NE', 'SN', 'TG']],
            ['id' => 152, 'type' => 1, 'name' => 'CFP franc',                        'code' => 'XPF', 'symbol' => '₣',   'decimals' => 0, 'status' => 1, 'used_countries' => ['PF', 'NC', 'WF']],
            ['id' => 153, 'type' => 1, 'name' => 'Yemeni rial',                      'code' => 'YER', 'symbol' => '﷼',  'decimals' => 2, 'status' => 1, 'used_countries' => ['YE']],
            ['id' => 154, 'type' => 1, 'name' => 'South African rand',               'code' => 'ZAR', 'symbol' => 'R',   'decimals' => 2, 'status' => 1, 'used_countries' => ['ZA']],
            ['id' => 155, 'type' => 1, 'name' => 'Zambian kwacha',                   'code' => 'ZMW', 'symbol' => 'ZK',  'decimals' => 2, 'status' => 1, 'used_countries' => ['ZM']],
            ['id' => 156, 'type' => 1, 'name' => 'Zimbabwe Dollar',                   'code' => 'ZWL', 'symbol' => '$',  'decimals' => 2, 'status' => 1, 'used_countries' => ['ZW']],
        ];
        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
