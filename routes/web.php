<?php

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Support\Facades\Route;

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
    return [config('app.name')];
});

Route::prefix("/api")->name('api.')->group(function(){

    //Route::get("/habits", [HabitController::class, 'index'])->name("habits.index");
    //Route::get("/habits/{habit:uuid}", [HabitController::class, 'show'])->name("habits.show");
    //Route::post("/habits", [HabitController::class, 'store'])->name("habits.store");
    //Route::put("/habits/{habit:uuid}", [HabitController::class, 'update'])->name("habits.update");
    //Route::delete("/habits/{habit:uuid}", [HabitController::class, 'destroy'])->name("habits.destroy");
    
    Route::apiResource('habits', HabitController::class)
        ->only(['index', 'store', 'destroy'])
        ->scoped(['habit'=>'uuid', 'log'=>'uuid']);

    Route::apiResource('habits.logs', HabitLogController::class)->scoped();
    //Route::get('/habits/{habit:uuid}/logs',[HabitLogController::class, 'index'])->name("habits.logs.index");
    //Route::post('/habits/{habit:uuid}/logs',[HabitLogController::class, 'store'])->name("habits.logs.store");
    //Route::delete('/habits/{habit:uuid}/logs/{log:uuid}',[HabitLogController::class, 'destroy'])->name("habits.logs.destroy");
});