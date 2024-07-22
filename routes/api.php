<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\DetailMeetingController;
use App\Http\Controllers\Auth\AuthenticationController;

Route::get('/', function () {
    return response([
        'message' => 'My API is working.',
    ], 200);
});

//get routes
Route::get('/meetings', [MeetingController::class, 'allMeeting']);
Route::get('/meeting/{id}', [MeetingController::class, 'search']);
Route::get('/meeting/detail/{id}', [DetailMeetingController::class, 'meetingDetail']);
Route::get('/available/meeting', [DetailMeetingController::class, 'available']);
Route::post('/detail/search', [DetailMeetingController::class, 'searchByLecturerName']);
// routes di atas sementara diluar middleware, karena masih development

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/index', [AuthenticationController::class, 'me']);
    Route::post('/update', [AuthenticationController::class, 'update']);

    //post routes
    Route::post('/newMeeting', [MeetingController::class, 'store']);
    Route::put('/register/meeting/{id}', [DetailMeetingController::class, 'registerMeeting']);
    Route::put('/delete/meeting/{id}', [DetailMeetingController::class, 'deleteMeeting']);
});

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
