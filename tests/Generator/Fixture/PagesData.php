<?php
namespace Tests\Generator\Fixture;

use Illuminate\Support\Str;

class PagesData
{
    public static function get()
    {
        return [
            FormData::get(),
            FormData::get(),
        ];
    }
}