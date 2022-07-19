<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Exception;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['students'] = Student::orderBy('id', 'desc')->paginate(5);
        return view('student.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
       $request->validate([
            'Fname' => 'required',
            'Mname' => 'required',
            'Lname' => 'required',
            'GrNo' => 'required',
            'DOB' => 'required',
            'Address' => 'required',
            'City' => 'required',
            'State' => 'required',
            'Country' => 'required',
            'ZipCode' => 'required',
            'ParentContactNumber' => 'required',
            'ProfilePicture' => 'required'
        ]);

        $image = $request->file('ProfilePicture');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('student/images'), $new_name);

        $student = new Student;
        $student->first_name = $request->Fname;
        $student->middle_name = $request->Mname;
        $student->last_name = $request->Lname;
        $student->gr_no = $request->GrNo;
        $student->dob = $request->DOB;
        $student->address = $request->Address;
        $student->city = $request->City;
        $student->state = $request->State;
        $student->country = $request->Country;
        $student->zipcode = $request->ZipCode;
        $student->parent_contact_number = $request->ParentContactNumber;
        $student->profile_pic = $new_name;

        $student->save();

        return redirect()->route('students.index');
            
    }
    catch(Exception $e){
        echo "<pre>";print_r($e->getMessage());
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
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student= Student::find($id);
        return view('student.edit', compact('student'));

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
            'Fname' => 'required',
            'Mname' => 'required',
            'Lname' => 'required',
            'GrNo' => 'required',
            'DOB' => 'required',
            'Address' => 'required',
            'City' => 'required',
            'State' => 'required',
            'Country' => 'required',
            'ZipCode' => 'required',
            'ParentContactNumber' => 'required',
            'ProfilePicture' => 'required'
        ]);

        $image = $request->file('ProfilePicture');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('student/images'), $new_name);
        
        $student = Student::find($id);

        $student->first_name = $request->Fname;
        $student->middle_name = $request->Mname;
        $student->last_name = $request->Lname;
        $student->gr_no = $request->GrNo;
        $student->dob = $request->DOB;
        $student->address = $request->Address;
        $student->city = $request->City;
        $student->state = $request->State;
        $student->country = $request->Country;
        $student->zipcode = $request->ZipCode;
        $student->parent_contact_number = $request->ParentContactNumber;
        $student->profile_pic = $new_name;
        $student->save();
       return redirect()->route('students.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    
     }
}
