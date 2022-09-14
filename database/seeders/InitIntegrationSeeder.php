<?php

namespace Database\Seeders;

use App\Enums\Integrations\Type;
use App\Models\Integration;
use Illuminate\Database\Seeder;

class InitIntegrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Integration::query()->where('type', Type::email())->doesntExist()) {
            Integration::factory()->create([
                'name' => "Email notifications",
                'desc' =>  "Receive an email every time there's a new submission of your form.",
            ]);
        }

    }
}
