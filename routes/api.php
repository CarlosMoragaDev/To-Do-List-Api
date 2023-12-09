<?php

use App\Http\Controllers\Api\AssignmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('assignments', AssignmentController::class);
Route::post('create_assignment', [AssignmentController::class, 'store']);
Route::put('status_assignment', [AssignmentController::class, 'statusAssignment']);
Route::delete('delete_assignment/{assignment}', [AssignmentController::class, 'destroy']);
