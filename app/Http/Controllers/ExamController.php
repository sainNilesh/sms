<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Standard;
use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::select(
            'exam.*',
            'subject.name as subject_name',
            'standard.title as standard_title'
        )
            ->leftjoin("standard", "standard.id", "exam.standard_id")
            ->leftjoin("subject", "subject.id", "exam.subject_id")
            ->orderby('exam.id', 'desc')
            ->paginate();

        return view('exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $subjects = Subject::all();
        $standards = Standard::all();

        return view('exams.create', compact('subjects', 'standards'));
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
            'title' => 'required',
            'standard_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'total_marks' => 'required'
        ]);


        $exam = new Exam();
        $exam->title = $request->title;
        $exam->standard_id = $request->standard_id;
        $exam->subject_id = $request->subject_id;
        $exam->date = $request->date;
        $exam->time = $request->time;
        $exam->duration = $request->duration;
        $exam->total_marks = $request->total_marks;
        $exam->save();
        return redirect()->route('exams.index');
        return view('exams.index', compact('subject'))
            ->with('success', 'exam have been create successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $exam = Exam::find($id);
        $subjects = Subject::all();
        $standards = Standard::all();
        return view('exams.edit', compact('exam', 'subjects', 'standards'));
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
            'title' => 'required',
            'standard_id' => 'required',
            'subject_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'total_marks' => 'required'
        ]);

        $exam = Exam::find($id);
        $exam->title = $request->title;
        $exam->standard_id = $request->standard_id;
        $exam->subject_id = $request->subject_id;
        $exam->date = $request->date;
        $exam->time = $request->time;
        $exam->duration = $request->duration;
        $exam->total_marks = $request->total_marks;
        $exam->save();

        return redirect()->route('exams.index')
            ->with('success', 'exam has been update successfully');
        return view('exams.index', compact('subject'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')
            ->with('success', 'exam has been deleted successfully');
    }
}
