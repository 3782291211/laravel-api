<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Exam;
use PHPUnit\Framework\Constraint\JsonMatches;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ExamCollection;
//use App\Utils\ProductQuery;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new ExamCollection(Exam::paginate(40));

        # the all() method on our model gets all of the models from the database
        // return new ProductCollection(Product::paginate(10));
        //return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     * POST request (Create)
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => 'required|string',
            "description" => 'required|string',
            "candidate_id" => 'required|numeric',
            "candidate_name" => 'required|string',
            "date" => 'required|date',
            "location_name" => 'required|string',
            "latitude" => 'required|decimal:0,25',
            "longitude" => 'required|decimal:0,25'
        ]);
        
        $exams = DB::table('exams')->get();

        if (
            $exams->contains('candidate_name', $request->candidate_name)
            && $exams->contains('date', $request->date)
            && $exams->contains('description', $request->description)
            && $exams->contains('price', $request->price)
            )
        {
            return response()->json([
                'msg' => 'Exam already exists.'
            ], 400);
        }
        else
        {
            return Exam::create($request->all());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ExamResource(Exam::find($id));
        //return Product::find($id);
    }

    /**
     * searches for records whose name attribute matches the provided substring
     * @param str $name
     * @return \Illuminate\Http\Response
     */
    public function search(string $name)
    {
        return Exam::where('candidate_name', 'like', '%' . $name . '%')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exam = Exam::find($id);
        $exam->update($request->all());
        return $exam;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Exam::destroy($id);
    }
}
