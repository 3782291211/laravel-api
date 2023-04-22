<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp() : void
    {
        parent::setUp();
        $newUser = [
            "name" => "Alex Pitfall",
		    "email" => "alex_pp7@v3.admin",
		    "password" => "uttdis8766ss",
		    "password_confirmation" => "uttdis8766ss"
        ];

        $res = $this->postJson('/api/signup', $newUser);
        Sanctum::actingAs(User::find($res['user']['id']));
    }

    public function test_get_request_returns_all_exams(): void
    {
        $response = $this->get('/api/exams');

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => 
                $json->has('exams', 37)
                     ->hasAll('links', 'meta')
            );
    }

    public function test_post_request_adds_exam_to_database(): void
    {
        $newExam =   [
            "title" => "VICTVS15",
            "description" => "VICTVS Exam 15",
            "candidate_id" => 0,
            "candidate_name" => "Wilmers",
            "date" => "05/05/2023 14:30:00",
            "location_name" => "London",
            "latitude" => 51.50374306483545,
            "longitude" => -0.14074641294861687
        ];
        
        $response = $this->postJson('/api/exams', $newExam);

        $response
            ->assertStatus(201)
            ->assertJson($newExam);
   
    }
}
