<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Exception;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['subjects'] = Subject::orderBy('id', 'desc')->paginate(5);
        return view('subjects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('subjects.create', compact('subjects'));
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
            'name' => 'required'
        ]);

        $subject = new Subject;
        $subject->name = $request->name;
        $subject->save();
        return redirect()->route('subjects.index')
            ->with('success', 'subject has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('subjects.edit', compact('subject'));
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
        //   try{

        $request->validate([
            'name' => 'required'
        ]);

        $subject = Subject::find($id);
        $subject->name = $request->name;
        $subject->save();

        //   }catch(Exception $e){
        //     echo $e->getMessage();
        //   }
        return redirect()->route('subjects.index')
            ->with('success', 'subject has been update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')
            ->with('success', 'subject has been delete succesfully');
    }
}
