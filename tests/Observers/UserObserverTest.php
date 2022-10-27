<?php
namespace Tests\Observers;

use App\Models\Integration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_created_integration()
    {
        $user = User::factory()->create();

        $this->assertEquals(1, Integration::query()->where('user_id', $user->id)->count());
    }
}