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
        return Exam::where('name', 'like', '%' . $name . '%')->get();
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
