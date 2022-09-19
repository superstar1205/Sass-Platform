<?php
namespace Tests\Generator\Fixture;

use Illuminate\Support\Str;

class InputData
{
    public static function get()
    {
        return [
            'id' => Str::uuid(),
            'type' => 'text',
            'label' => Str::uuid(),
            'required' => true,
            'placeholder' => Str::uuid(),
            'help' => Str::uuid()
        ];
    }
}