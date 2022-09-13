<?php
namespace Database\Factories;

use App\Enums\Responses\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResponseFactory extends Factory
{
    public function definition()
    {
        return [
            'form_id' => 1,
            'form_data' => [],
            'status' => Status::ongoing()
        ];
    }
}