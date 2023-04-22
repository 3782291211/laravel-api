<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use App\Models\Exam;

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
                $json->has('exams', 30)
                     ->hasAll('links', 'meta')
            );
    }


    public function test_get_returns_exams_sorted_in_desc_date_order_by_default(): void
    {
        // Get an array of Exams directly from the database, ordered by date DESC
        $examsFromDb = Exam::orderBy('date', 'desc')->get()->toArray();
        $datesFromDb = array_slice(
            array_map(fn ($m) => $m['date'], $examsFromDb), 0, 50
        );
        
        // Get an array of Exams via the API, of the same length as the above array.
        $response = $this->get('/api/exams?limit=50');
        $datesFromApi = array_map(fn ($m) => $m['date'], $response['exams']);

        // Assert that the response objects must be sorted in the correct order.
        $response->assertStatus(200);
        $this->assertEquals($datesFromDb, $datesFromApi);
    }


    public function test_get_allows_exams_to_be_sorted_in_asc_order(): void
    {
         $examsFromDb = Exam::orderBy('date', 'asc')->get()->toArray();
         $datesFromDb = array_slice(
             array_map(fn ($m) => $m['date'], $examsFromDb), 0, 50
         );
         
         $response = $this->get('/api/exams?limit=50&order=asc');
         $datesFromApi = array_map(fn ($m) => $m['date'], $response['exams']);
 
         $response->assertStatus(200);
         $this->assertEquals($datesFromDb, $datesFromApi);
    }


    public function test_get_allows_exams_to_be_filtered_by_location(): void
    {
        $response = $this->get('/api/exams?location=london');
        $response->assertStatus(200)
                 ->assertJson(fn (AssertableJson $json) =>
                        $json->has('exams', 2, fn (AssertableJson $json) =>
                                $json->where('locationName', 'London')
                                     ->etc()
                        )->etc()
                );
    }


    public function test_get_request_returns_all_users(): void
    {
        $response = $this->get('/api/users');
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has(11)
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


    public function test_put_admin_can_update_any_exam(): void
    {
        $response = $this->putJson('/api/exams/12', [
            'title' => 'new title',
            'location_name' => 'Liverpool',
            'description' => 'new description goes here'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where('title', 'new title')
                     ->where('location_name', 'Liverpool')
                     ->where('description', 'new description goes here')
                     ->hasAll(['id', 'title', 'description', 'location_name', 'candidate_id', 'candidate_name', 'date', 'longitude', 'latitude'])
                     ->etc()
            );
    }
}
