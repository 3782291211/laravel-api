<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Exam;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if (!Gate::allows('view-users')) {
            return response(['msg' => 'Administrator access is required to perform this action.'], 403);
        }

        return response(['users' => User::all()]);
    }

    public function userExams(int $id)
    {
        return response([
            'exams' => Exam::where('candidate_id' , '=', $id)
                            ->orderBy('date', 'asc')
                            ->get()
        ]);
    }
}
