<?php
namespace Tests\Generator\Fixture;

use Illuminate\Support\Str;

class ScaleData
{
    public static function get()
    {
        return [
            'id' => Str::uuid(),
            'max' => 9,
            'min' => 1,
            'help' => 'help',
            'type' => 'scale',
            'label' => 'test-scale',
            'required' => true,
            'from_label' => '小',
            'center_label' => '中',
            'to_label' => '大',
        ];
    }
}