<?php

use App\Http\Controllers\ConsumableController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\CounterReadingController;
use App\Http\Controllers\CounterTypeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentModelController;
use App\Http\Controllers\EquipmentTypeController;
use App\Http\Controllers\FaultNodeController;
use App\Http\Controllers\Material;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialType;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegulationConroller;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TechnicalMaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProjectController;
use App\Models\Consumable;
use App\Models\EquipmentModel;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//
//});

Route::middleware(['auth:sanctum', 'throttle:100,3'])->group(function () {
    Route::get('/user', [UserController::class, 'showCurrentUser']);                         // Получить список пользователей
    Route::get('/users', [UserController::class, 'index']);                         // Получить список пользователей
    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::patch('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/resources', [ResourceController::class, 'index']);
    Route::post('/resources', [ResourceController::class, 'store']);
    Route::get('/resources/{id}', [ResourceController::class, 'show']);
    Route::patch('/resources/{id}', [ResourceController::class, 'update']);
    Route::delete('/resources/{id}', [ResourceController::class, 'destroy']);

    Route::get('/requests', [RequestController::class, 'index']);
    Route::get('/requests/{id}', [RequestController::class, 'show']);
    Route::post('/requests', [RequestController::class, 'store']);
    Route::post('/requests/{id}/approve', [RequestController::class, 'approve']);
    Route::post('/requests/{id}/close', [RequestController::class, 'close']);
    Route::delete('/requests/{id}', [RequestController::class, 'destroy']);


    Route::delete('/user-resources/{id}', [\App\Http\Controllers\UserResourceController::class, 'destroy']);
});

Route::middleware('throttle:10,2')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});


// Возвращение ошибки о некорректности токена
Route::any('/errorToken', function () {
    return response()->json(['message' => 'Unauthorized: Invalid token'], 401);
})->name("login");
