<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CageController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RefSensorController;
use App\Http\Controllers\SensorController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
/*auth controller */
  Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
  });
/* */
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/register', [AuthController::class, 'register']);

  Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/refsensor', [RefSensorController::class, 'index']);
    Route::get('/refsensor/{id}', [RefSensorController::class, 'show']);
    Route::post('/refsensor', [RefSensorController::class, 'store']);
    Route::put('/refsensor/{id}', [RefSensorController::class, 'update']);
    Route::delete('/refsensor/{id}', [RefSensorController::class, 'destroy']);

    Route::get('/device', [DeviceController::class, 'index']);
    Route::get('/device/{id}', [DeviceController::class, 'show']);
    Route::post('/device', [DeviceController::class, 'store']);
    Route::put('/device/{id}', [DeviceController::class, 'update']);
    Route::delete('/device/{id}', [DeviceController::class, 'destroy']);

    Route::get('/cage', [CageController::class, 'index']);
    Route::get('/cage/{id}', [CageController::class, 'show']);
    Route::post('/cage', [CageController::class, 'store']);
    Route::put('/cage/{id}', [CageController::class, 'update']);
    Route::delete('/cage/{id}', [CageController::class, 'destroy']);

    Route::get('/sensor', [SensorController::class, 'index']);
    Route::get('/sensor/{id}', [SensorController::class, 'show']);
    Route::post('/sensor', [SensorController::class, 'store']);
    Route::put('/sensor/{id}', [SensorController::class, 'update']);
    Route::delete('/sensor/{id}', [SensorController::class, 'destroy']);

    Route::get('/record', [RecordController::class, 'index']);
    Route::get('/record/stat/{id_kandang}/{id_sensor}', [RecordController::class, 'stat']);
    Route::get('/record/stat_ref/{id_kandang}/{id_sensor}', [RecordController::class, 'stat_ref']);
  });
  Route::post('/record', [RecordController::class, 'store']);
});