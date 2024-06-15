<?php

use App\Livewire\Cas102;
use App\Livewire\Cas103;
use App\Livewire\Cas104;
use App\Livewire\Cas105;
use App\Livewire\Cas106;
use App\Livewire\CICTSO;
use App\Livewire\Skylab;
use App\Models\Computer;
use App\Livewire\Cas1stFloor;
use App\Livewire\Cas2ndFloor;
use App\Livewire\Cas3rdFloor;
use App\Livewire\Cas4thFloor;
use App\Livewire\CsitFaculty;
use Filament\Facades\Filament;
use App\Livewire\BuildingButton;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LayoutController;
use Filament\Http\Middleware\FilamentMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/building-button', BuildingButton::class)->name('building-button');
Route::prefix('casfloor')->group(function () {
    Route::get('/cas1st-floor/{floorId}', Cas1stFloor::class)->name('cas1st-floor');
    Route::get('/cas2nd-floor/{floorId}', Cas2ndFloor::class)->name('cas2nd-floor');
    Route::get('/cas3rd-floor/{floorId}', Cas3rdFloor::class)->name('cas3rd-floor');
    Route::get('/cas4th-floor/{floorId}', Cas4thFloor::class)->name('cas4th-floor');
    Route::get('/cas106/{roomId}', Cas106::class)->name('cas106');
    Route::get('/cas105/{roomId}', Cas105::class)->name('cas105');
    Route::get('/cas104/{roomId}', Cas104::class)->name('cas104');
    Route::get('/cas103/{roomId}', Cas103::class)->name('cas103');
    Route::get('/cas102/{roomId}', Cas102::class)->name('cas102');
    Route::get('/c-i-c-t-s-o/{roomId}', CICTSO::class)->name('c-i-c-t-s-o');
    Route::get('/csit-faculty/{roomId}', CsitFaculty::class)->name('csit-faculty');
    Route::get('/skylab/{roomId}', Skylab::class)->name('skylab');

});

Route::put('computers/{computer}', [Cas106::class, 'updatePosition'])->name('computers.updatePosition');
Route::get('computers/{computer}/mapping', [Computer::class, 'showMapping'])->name('computer.mapping');

Route::get('/layout/print/{roomId}', [LayoutController::class, 'print'])->name('layout.print');
Route::get('/print-layout/{roomId}', [RoomController::class, 'printLayout'])->name('layout.print');
