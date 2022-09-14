<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::query()->where('email', 'admin@formed.com')->doesntExist()) {
            User::factory()->create([
                'email' => 'admin@formed.com',
                'name' => 'admin',
                'password' => Hash::make('password')
            ]);
        }

    }
}
