<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo bcrypt('yash@123');
        $students = Student::orderBy('id', 'desc')->paginate(3);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gr_no' => 'required|min:6|max:8|unique:student',
            'dob' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'parent_contact_number' => 'required',
            'parent_email' => 'required',
            'profile_pic' => 'required'
        ]);
        // AfnrU!
        $password = substr(str_shuffle("0123456789@#@!abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        $image = $request->file('profile_pic');
        $profile_pic = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('student/images'), $profile_pic);
        $student = new Student;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->gr_no = $request->gr_no;
        $student->password = bcrypt($password);
        $student->dob = $request->dob;
        $student->address = $request->address;
        $student->city = $request->city;
        $student->state = $request->state;
        $student->country = $request->country;
        $student->zipcode = $request->zipcode;
        $student->parent_contact_number = $request->parent_contact_number;
        $student->parent_email = $request->parent_email;
        $student->profile_pic = $profile_pic;

        if ($student->save()) {

            $data = [
                'email' => $request->parent_email,
                'password' => $password
            ];

            Mail::send('mails.student_account', $data, function ($message) use ($data) {
                $message->to($data['email'])
                    ->subject('Student Account created');
            });

            return redirect()->route('students.index')
                ->with('success', 'student has been created successfully');
        } else {
            return redirect()->route('students.index')
                ->with('error', 'something went wrong');
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
        $student = Student::fine($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit', compact('student'));
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gr_no' => 'required|min:6|max:8|unique:student,gr_no,' . $id,
            'dob' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'parent_contact_number' => 'required',
            'parent_email' => 'required',
        ]);
        $student = Student::find($id);
        $profile_pic = !empty($student->profile_pic) ? $student->profile_pic : "";
        if ($request->hasFile('ProfilePicture')) {
            $image = $request->file('ProfilePicture');
            $profile_pic = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('student/images'), $profile_pic);
        }

        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->gr_no = $request->gr_no;
        $student->dob = $request->dob;
        $student->address = $request->address;
        $student->city = $request->city;
        $student->state = $request->state;
        $student->country = $request->country;
        $student->zipcode = $request->zipcode;
        $student->parent_contact_number = $request->parent_contact_number;
        $student->parent_email = $request->parent_email;
        $student->profile_pic = $profile_pic;
        $student->save();
        return redirect()->route('students.index')
            ->with('success', 'students has been update successfully');
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
        return redirect()->route('students.index')
            ->with('success', 'student has been deleted successfully');
    }
}
