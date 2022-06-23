<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyEntryController;
use Illuminate\Support\Facades\Route;

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
})->middleware(['auth'])->name('dashboard');

Route::get('survey', [SurveyController::class, 'index'])->name('survey.index');
Route::get('survey/{survey}', [SurveyController::class, 'show'])->name('survey.show');
Route::post('survey-entries/{survey}', [SurveyEntryController::class, 'store'])->name('survey-entry.store');

require __DIR__ . '/auth.php';
