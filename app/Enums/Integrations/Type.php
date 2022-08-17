<?php
namespace App\Enums\Integrations;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * Class Type
 * @package App\Enums\Integrations
 * @method static self email()
 */
class Type extends Enum {

    #[ArrayShape(['email' => "int"])] protected static function values(): array
    {
        return [
            'email' => 0,
        ];
    }
};