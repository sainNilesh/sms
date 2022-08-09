<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use App\Models\Student;
use App\Models\StudentStandard;
use Illuminate\Http\Request;

class StudentStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentStandard = StudentStandard::select(
            'student_standard.*',
            'student.first_name',
        )
            ->leftjoin("student", "student.id", "student_standard.student_id")
            ->orderBy("student_standard.id", "desc")
            ->paginate();

        return view('student_standards.index', compact('studentStandard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = Student::all();
        $standard = Standard::all();
        return view('student_standards.create', compact('student', 'standard'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'standard_id' => 'required',
            'year' => 'required'
        ]);

        $studentStandard = new StudentStandard();
        $studentStandard->student_id = $request->student_id;
        $studentStandard->standard_id = $request->standard_id;
        $studentStandard->year = $request->year;
        $studentStandard->save();

        return redirect()->route('student_standards.index')
            ->with('success', 'student standard has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $studentStandard = StudentStandard::fine($id);
        return view('student_standards.show', compact('studentStandard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::all();
        $standards= Standard::all();
        $student_standard=StudentStandard::find($id);
        $studentStandard = StudentStandard::select('student_id')->where('standard_id', $id)->pluck('student_id')->toArray();
        return view('student_standards.edit', compact('students','standards','student_standard'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' =>'required',
            'standard_id' =>'required',
            'year' => 'required'
        ]);

        $studentStandard =  StudentStandard::find($id);
        $studentStandard->student_id = $request->student_id;
        $studentStandard->standard_id = $request->standard_id;
        $studentStandard->year = $request->year;
        $studentStandard->save();

        return redirect()->route('student_standards.index')
            ->with('success', 'student standard has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentStandard $studentStandard)
    {
        $studentStandard->delete();
        return redirect()->route('student_standards.index')
            ->with('success', 'student standard has been deleted successfully');
    }
}
