<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware("auth:api")->group(function () {

Route::post("login", [ApiController::class, "login"]);
Route::post("logout", [ApiController::class, "logout"]);
Route::post("forget_password", [ApiController::class, "forget_password"]);
Route::post("ResendOtp", [ApiController::class, "ResendOtp"]);
Route::post("VerifyOtp", [ApiController::class, "VerifyOtp"]);
Route::post("ResetPassword", [ApiController::class, "ResetPassword"]);

Route::group(['middleware' => 'ApiAuthentication:return_type_object'], function () {

    Route::post("GetStudentProfile", [ApiController::class, "GetStudentProfile"]);
    Route::post("StudentUpdateProfile", [ApiController::class, "StudentUpdateProfile"]);
    Route::get("Examdetails/{exam_id}", [ApiController::class, "ExamDetails"]);
});
Route::group(['middleware' => 'ApiAuthentication:return_type_array'], function () {
    Route::post("ExamList", [ApiController::class, "ExamList"]);
});
