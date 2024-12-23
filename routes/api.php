<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
// use App\Http\Controllers\AssignmentController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::options('{any}', function () {
    return response()->json(['status' => 'OK'], 200);
})->where('any', '.*');

Route::prefix('v1')->group(function () {
    // Rutas para hoteles
    Route::apiResource('hotels', HotelController::class);

    // Rutas para habitaciones
    Route::apiResource('rooms', RoomController::class);
    // Route::apiResource('departments', RoomController::class);
    Route::get('/departments', [DepartmentController::class, 'getDepartments']);
    Route::get('/departments/{id}/municipalities', [DepartmentController::class, 'getMunicipalitiesByDepartment']);
    Route::get('/accommodationsassignments', [AccommodationController::class, 'getAll']);

    // Rutas para asignaciones
    // Route::apiResource('assignments', AssignmentController::class);
});
