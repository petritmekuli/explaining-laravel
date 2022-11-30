<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Tutorials\Facades\StringModifier;
use App\Tutorials\Facades\StringModifierFacade;

// use App\Tutorials\Facades\StringModifier;
// use App\Tutorials\Facades\StringModifierFacade;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Dependency Injection
// Route::get('/StringModifier', function(StringModifier $string){
//     // app()->make(StringModifier::class)->reverse('petrit');
//     $string->reverse('petrit');
// });

//Facade
Route::get('/StringModifier', function(){
    StringModifierFacade::reverse('petrit');
});
