<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\UserToken;
use App\Models\Student;

class ApiAuthentication
{

    public function __construct()
    {
        $this->controller = new Controller();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $return_type)
    {
        if ($request->header('token') != NULL) {
            $token = $request->header('token');
            $auth_token = UserToken::where('auth_token', $token)->get()->toArray();

            if (count($auth_token) > 0) {
                $student_id = $auth_token[0]['user_id'];
                $student = Student::where("id", $student_id)->first();

                if (isset($student)) {
                    $request->merge(['_user_id' => $student_id]);
                    return $next($request);
                }
            }
        }
        if ($return_type == "return_type_object") {
            return response()->json([
                'status' => 0,
                'message' => 'Unauthorized user',
                'data' => (object)array()
            ], 400);
        }
        return response()->json([
            'status' => 0,
            'message' => 'Unauthorized user',
            'data' => array()
        ], 400);
    }
}
