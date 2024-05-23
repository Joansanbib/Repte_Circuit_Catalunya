
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidenceController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserResolController;
use Illuminate\Support\Facades\Auth;

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
    return view('dashboard');
})->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/logout', function (){
    Auth::logout();
    return redirect('/');
})->middleware('auth');

Route::resource('incidences', IncidenceController::class)->middleware('auth');;
Route::get('/incidences/delete/{incidence}', [IncidenceController::class, 'destroy'])->name('incidences.destroy')->middleware('auth');;
Route::resource('zones', ZoneController::class)->middleware('auth');;
Route::resource('users', UserController::class)->middleware('auth');;
Route::get('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');;
Route::resource('user_resols', UserResolController::class)->middleware('auth');;
