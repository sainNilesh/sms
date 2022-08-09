<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Student;
use App\Models\StudentStandard;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Exception;
// manage api in middleware
// ->change response of exam list api


class ApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'GrNo' => 'required',
            'password' => 'required'
        ]);
        // check student
        $student = Student::where("gr_no", "=", $request->GrNo)->first();
        if (isset($student)) {
            if (Hash::check($request->password, $student->password)) {

                //create a token 
                $token = substr(str_shuffle("0123456789@#@!abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 25);
                UserToken::create([
                    'user_id' => $student->id,
                    'auth_token' => $token
                ]);
                ///send a response
                return response()->json([
                    'status' => 1,
                    'message' => 'Student logged in successfully',
                    'auth_token' => $token
                ], 200);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Password did not match'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Student not found'
            ], 404);
        }
    }
    //logout api
    public function logout(Request $request)
    {
        $student_id = isset($request->user_id)  ? $request->user_id : 0;
        DB::table('user_tokens')->where('user_id', $student_id)->delete();


        return response()->json([
            'status' => 1,
            'message' => 'Successfully logged out'
        ], 200);
    }
    public function forget_password(Request $request)
    {

        if (!isset($request->email)) {
            return response()->json([
                'status' => 0,
                'msg' => 'invalid request'
            ], 400);
        }

        $otp = rand(1000, 9999);

        $email = trim($request->email);
        $emailAuth = Student::where('parent_email', '=', $email)
            ->first();

        if ($emailAuth == null) {
            return response()->json([
                'status' => 0,
                'msg' => 'invalid email'
            ], 400);
        }

        $name = $emailAuth->first_name . " " . $emailAuth->middle_name . " " . $emailAuth->last_name;
        $email = $emailAuth->parent_email;

        $userData = [
            'name' => $name,
            'email' => $email,
            'otp' => $otp
        ];

        $emailAuth->otp = $otp;

        if ($emailAuth->save() == true) {
            $isSent = $this->sendForgotPasswordMail($userData);

            if ($isSent == true) {
                return response()->json([
                    'status' => 1,
                    'msg' => 'email send successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 0,
                    'msg' => 'erorr while  sending  mail'
                ], 400);
            }
        }
        return response()->json([
            'msg' => 'something went wrong'
        ], 500);
    }

    public function sendForgotPasswordMail($userData)
    {
        try {
            Mail::send('mails.forget_password', $userData, function ($message) use ($userData) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->to(trim($userData['email']))
                    ->subject('forgot password mail');
            });
        } catch (Exception $e) {
        }
        return true;
    }

    public function ResendOtp(Request $request)
    {
        if (!isset($request->email)) {
            return response()->json([
                'status' => 0,
                'msg' => 'invalid request'
            ], 400);
        }

        $email = trim($request->email);

        $emailAuth = Student::where('parent_email', '=', $email)
            ->first();

        if ($emailAuth == null) {
            return response()->json([
                'status' => 0,
                'msg' => 'invalid email'
            ], 400);
        }

        $otp = rand(1000, 9999);

        $userData = [
            'name' => $emailAuth->first_name . " " . $emailAuth->middle_name . " " . $emailAuth->last_name,
            'email' => $email,
            'otp' => $otp
        ];
        Student::where('parent_email', '=', $email)->update(['otp' => $otp]);
        try {
            // send otp to email using email api
            Mail::send('mails.resend_otp', $userData, function ($message) use ($userData) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->to(trim($userData['email']))
                    ->subject('resend otp mail');
            });
        } catch (Exception $e) {
        }

        return response()->json([
            'status' => 1,
            'msg' => 'email send successfully'
        ], 200);
    }
    /**
     * 
     */
    public function VerifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'otp' => 'required'
        ]);
        $student = Student::where("parent_email", "=", $request->email)
            ->where('otp', '=', $request->otp)->first();
        if (isset($student)) {

            return response()->json([
                'status' => 1,
                'message' => "otp match successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'otp did not match'
            ], 404);
        }
    }
    public function ResetPassword(Request $request)
    {

        if (
            !isset($request->email) ||
            !isset($request->password) ||
            !isset($request->confirm_password)
        ) {
            return response()->json([
                'status' => 0,
                'msg' => 'invalid request'
            ], 400);
        }

        $email = trim($request->email);
        $password = trim($request->password);
        $confirm_password = trim($request->confirm_password);

        $userData = [
            'email' => $email,
            'password' => $password
        ];

        $student = Student::where("parent_email", "=", $request->email)->first();

        if (isset($student)) {
            if ($password === $confirm_password) {

                // both password and confirm password are matached, please update the password and send new password in the email
                Student::where('parent_email', '=', $email)->update(['password' => bcrypt($password)]);
                try {
                    Mail::send('mails.reset_password', $userData, function ($message) use ($userData) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                            ->to(trim($userData['email']))
                            ->subject('reset password mail');
                    });
                } catch (Exception $e) {
                }
                return response()->json([
                    'status' => 1,
                    'msg' => 'email send successfully'
                ], 200);
            } else {

                // password and confirm password does not match
                return response()->json([
                    'status' => 0,
                    'message' => 'Password did not match'
                ], 400);
            }
        }
        return response()->json([
            'status' => 0,
            'message' => 'email does not exists'
        ], 400);
    }

    public function GetStudentProfile(Request $request)
    {
        $student_id = isset($request->_user_id) ? $request->_user_id : 0;
        $student = Student::find($student_id);

        return response()->json([
            'status' => 1,
            'message' => 'student profile data',
            'data' => $student
        ], 400);
    }
    public function StudentUpdateProfile(Request $request)
    {
        $student_id = isset($request->_user_id) ? $request->_user_id : 0;

        $student = Student::find($student_id);
        if (!empty($student)) {

            $profile_pic = !empty($student->profile_pic) ? $student->profile_pic : "";
            if ($request->hasFile('profile_pic')) {
                $image = $request->file('profile_pic');
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
            $student->profile_pic = $profile_pic;
            if ($student->save() == true) {
                return response()->json([
                    'status' => 1,
                    'message' => 'student updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => "something went wrong ",
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'student not found',
            ], 400);
        }
    }
    public function ExamList(Request $request)
    {
        $student_id = isset($request->_user_id) ? $request->_user_id : 0;

        $standardData = StudentStandard::where('student_id', $student_id)->first();
        $standard_id = !empty($standardData->standard_id) ? $standardData->standard_id : 0;

        $exams = array();
        if (!empty($standard_id)) {
            $exams = Exam::select(
                'exam.id',
                'subject.name as subject_name',
                'standard.title as standard_title',
                'exam.title',
                'exam.date',
                'exam.time',
                'exam.duration',
                'exam.total_marks'
            )
                ->leftjoin("standard", "standard.id", "exam.standard_id")
                ->leftjoin("subject", "subject.id", "exam.subject_id")
                ->where('standard_id', $standard_id)
                ->whereYear('exam.date', date('Y'))
                ->get()->toArray();
        }
        return response()->json([
            'status' => 1,
            'message' => 'exam data',
            'data' => $exams
        ], 200);
    }
    public function ExamDetails($exam_id)
    {
        $exam = Exam::find($exam_id);

        return response()->json([
            'status' => 1,
            'message' => 'exam data',
            'data' => $exam
        ], 200);
    }
}
