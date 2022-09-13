<?php
namespace Database\Factories;

use App\Enums\Integrations\Status;
use App\Enums\Integrations\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class IntegrationFactory extends Factory
{
    #[ArrayShape([
        'name' => "string", 'desc' => "string", 'type' => "\App\Enums\Integrations\Type",
        'status' => "\App\Enums\Integrations\Status"
    ])] public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'desc' => $this->faker->text(),
            'type' => Type::email(),
            'status' => Status::disable(),
        ];
    }
}