<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Standard;
use App\Models\Subject;
use App\Models\StandardSubject;
use Exception;
use Illuminate\Support\Facades\DB;
use raw;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $standards = Standard::select(
            'standard.*',
            DB::raw('count(standard.id) as total_subjects'),
            DB::raw("group_concat(subject.name SEPARATOR ', ') as names")
        )
            ->leftJoin("standard_subject", "standard.id", "standard_subject.standard_id")
            ->leftJoin("subject", "standard_subject.subject_id", "subject.id")
            ->groupBy('standard.id')
            ->orderBy('standard.id', 'desc')
            ->paginate();

        return view('standards.index', compact('standards'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('standards.create', compact('subjects'));
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
            'title' => 'required'
        ]);

        $standard = new Standard();
        $standard->title = $request->title;
        if ($standard->save() == true) {
            $standard_id = $standard->id;
            if (!empty($request->subjects)) {
                foreach ($request->subjects as $subject) {
                    StandardSubject::create([
                        'standard_id' => $standard_id,
                        'subject_id' => $subject
                    ]);
                }
            }
            return redirect()->route('standards.index');
            return view('standards.index', compact('subject'))
                ->with('success', 'standard has been created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('standards.show', compact('standard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects = Subject::all();
        $standard = Standard::find($id);
        $standardSubjects = StandardSubject::select('subject_id')->where('standard_id', $id)->pluck('subject_id')->toArray();
        return view('standards.edit', compact('standard', 'subjects', 'standardSubjects'));
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
        ]);
        $standard = Standard::find($id);
        $standard->title = $request->title;
        $standard->save();

        $standard_id = $id;
        if (!empty($request->subjects)) {
            StandardSubject::where('standard_id', $standard_id)->delete();
            foreach ($request->subjects as $subject) {
                StandardSubject::create([
                    'standard_id' => $standard_id,
                    'subject_id' => $subject
                ]);
            }
        }

        return redirect()->route('standards.index')
            ->with('success', 'standard update has been successfully');
        return view('standards.index', compact('subject'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Standard $standard)
    {
        $standard->delete();
        return redirect()->route('standards.index')
            ->with('success', 'standard has been  successfully');
    }
}
