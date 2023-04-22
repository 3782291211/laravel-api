<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UnauthorisedUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_unauthorised_user_cannot_view_full_list_of_exams(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/api/exams');

        $response->assertStatus(403);
        $response->assertExactJson(['msg' => 'Administrator access is required to perform this action.']);
    }
}
