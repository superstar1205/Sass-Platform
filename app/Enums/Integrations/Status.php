<?php
namespace App\Enums\Integrations;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * Class IntegrationStatus
 * @package App\Enums\Integrations
 * @method static self enable()
 * @method static self disable()
 */
class Status extends Enum {

    #[ArrayShape(['disable' => "int", 'enable' => "int"])] protected static function values(): array
    {
        return [
            'disable' => 0,
            'enable' => 1,
        ];
    }
};