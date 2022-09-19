<?php
namespace Tests\Generator\Fixture;

use Illuminate\Support\Str;

class FormData
{
    public static function get()
    {
        return [
            'id' => Str::uuid(),
            'blocks' => [
                [
                    'id' => Str::uuid(),
                    'options' => [
                        [
                            'id' => Str::uuid(),
                            'value' => Str::uuid()
                        ],
                        [
                            'id' => Str::uuid(),
                            'value' => Str::uuid()
                        ],
                        [
                            'id' => Str::uuid(),
                            'value' => Str::uuid()
                        ]
                    ],
                    'required' => false,
                    'label' => Str::uuid(),
                    "type" => "radio",
                    'help' => Str::uuid(),
                ],
                [
                    'id' => Str::uuid(),
                    'options' => [
                        [
                            'id' => Str::uuid(),
                            'value' => Str::uuid()
                        ],
                        [
                            'id' => Str::uuid(),
                            'value' => Str::uuid()
                        ],
                        [
                            'id' => Str::uuid(),
                            'value' => Str::uuid()
                        ]
                    ],
                    'required' => false,
                    'label' => Str::uuid(),
                    "type" => "checkout",
                    'help' => Str::uuid(),
                ],
                InputData::get()
            ],
            'button' => Str::uuid(),
        ];
    }

    public static function getByInitBtn(): array
    {
        $btn = self::get();
        $btn['button'] = [
            'text' => Str::uuid(),
            'text_color' => Str::uuid(),
            'bg_color' => Str::uuid(),
        ];
        $btn['logo'] = [
            'src' => 'http://127.0.0.1:8001/storage/images/cXAuZCdMOHYBDXw083yYRQ2PVOMTV5GabmynwOTE.png',
            'class' => 'small'
        ];
        return $btn;
    }
}