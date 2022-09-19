<?php
namespace Tests\Generator\Fixture;

use Illuminate\Support\Str;

class H2Data
{
    public static function get()
    {
        return [
            'id' => Str::uuid(),
            'type' => 'h2',
            'content' => Str::uuid(),
        ];
    }
}