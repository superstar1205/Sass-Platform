<?php
namespace Tests\Generator\Fixture;

use Illuminate\Support\Str;

class ThinkYouPageData
{
    public static function get()
    {
        return [
            'blocks' => [
                [
                    'id' => Str::uuid(),
                    'type' => 'h1',
                    'content' => 'All done. Thank you!'
                ],
                [
                    'id' => Str::uuid(),
                    'type' => 'rich_text',
                    'content' => 'Your answers have successfully been recorded.'
                ]
            ],
            'redirect' => false,
        ];
    }
}