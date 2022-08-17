<?php
namespace App\Enums\Responses;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * Class Status
 * @package App\Enums\Responses
 * @method static self ongoing()
 * @method static self finished()
 */
class Status extends Enum {

    #[ArrayShape(['ongoing' => "int", 'finished' => "int"])] protected static function values(): array
    {
        return [
            'ongoing' => 0,
            'finished' => 1,
        ];
    }
};