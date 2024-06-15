<?php

use App\Models\User;
use App\Livewire\Cas105;
use App\Livewire\Cas106;
use Illuminate\Http\Request;
use App\Livewire\Cas1stFloor;
use App\Livewire\Cas2ndFloor;
use App\Livewire\Cas3rdFloor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComputerController;
use Illuminate\Validation\ValidationException;

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

Route::put('/computers/positions', [Cas106::class, 'updatePositions'])->name('computers.updatePositions');

Route::put('/computers/{computer}/position', [ComputerController::class, 'updatePosition'])->name('computers.updatePosition');

Route::put('/computers/{computer}/position', [Cas105::class, 'updatePosition'])->name('computers.updatePosition');
Route::put('/rooms/{room}/position', [Cas1stFloor::class, 'updatePositions'])->name('rooms.updatePositions');
Route::put('/rooms/positions', [Cas2ndFloor::class, 'updatePositions'])->name('rooms.updatePositions');
Route::put('/rooms/positions', [Cas3rdFloor::class, 'updatePositions'])->name('rooms.updatePositions');
Route::post('/computers/{computer}/position', [Cas106::class, 'updatePositions'])->name('computers.updatePositions');

Route::post('/login', [AuthController::class, 'login']);


Route::get('/get-room-positions', [Cas1stFloor::class, 'getRoomPositions']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/buildings', [BuildingController::class, 'index']);

Route::get('/most-not-working-rooms', [RoomController::class, 'getRoomWithMostNotWorkingComputers']);

Route::get('/buildings/{buildingId}/floors', [BuildingController::class, 'getFloors']);

Route::get('/floors', [FloorController::class, 'index']);
Route::get('/floors/{id}', [FloorController::class, 'show']);

Route::get('/floors/{floorId}/rooms', [RoomController::class, 'getRoomsByFloor']);
Route::get('/rooms/{roomId}', [RoomController::class, 'getRoomDetails']);

Route::get('/rooms/{roomId}/computers', [ComputerController::class, 'getComputersByRoom']);
Route::get('/computers/{computerId}', [ComputerController::class, 'getComputerDetails']);
Route::put('/computers/{computer}/remarks', [ComputerController::class, 'updateRemarks']);

Route::put('/computers/{computer}/status', [ComputerController::class, 'updateStatus']);

Route::middleware('auth:sanctum')->put('/user/update', [UserController::class, 'updateUser']);

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);
