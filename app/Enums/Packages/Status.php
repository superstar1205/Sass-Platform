<?php
namespace App\Enums\Packages;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * Class Status
 * @package App\Enums\Packages
 * @method static self hidden()
 * @method static self visible()
 */
class Status extends Enum
{
    #[ArrayShape(['hidden' => "int", 'visible' => "int"])] protected static function values(): array
    {
        return [
            'hidden' => 0,
            'visible' => 1,
        ];
    }
}