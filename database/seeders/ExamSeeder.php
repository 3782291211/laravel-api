<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exam::factory()
            ->count(30)
            ->create();
    }
}

class JsonSeeder extends Seeder
{
    public function run(): void
    {
        $json = Storage::disk('local')->get('/json/candidate_data.json');
        $candidates = json_decode($json, true);

        foreach ($candidates as $candidate)
        {
            DB::table('exams')->insert([
                "title" => $candidate['title'],
                "description" => $candidate['description'],
                "candidate_id" => $candidate['candidate_id'],
                "candidate_name" => $candidate['candidate_name'],
                "date" => $candidate['date'],
                "location_name" => $candidate['location_name'],
                "latitude" => $candidate['latitude'],
                "longitude" => $candidate['longitude']
            ]);
        }
    }
}