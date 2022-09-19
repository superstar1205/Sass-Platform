<?php
namespace Tests\Generator\Fixture;

use Illuminate\Support\Str;

class MetaData
{
    public static function get()
    {
        return [
            'id' => Str::uuid(),
            'name' => Str::uuid(),
            'slug' => Str::uuid(),
            'pages' => PagesData::get(),
            'branding' => [
                "button" => "#FFFFFF",
                "primary_color" => "#60A5FA",
                'logo' => 'http://127.0.0.1:8001/storage/images/cXAuZCdMOHYBDXw083yYRQ2PVOMTV5GabmynwOTE.png',
                'logoSize' => 'small'
            ],
            'thank_you_page' => ThinkYouPageData::get(),
            'current_page' => 1
        ];
    }
}