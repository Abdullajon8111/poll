<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EDSController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\LanguageController;
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

Route::redirect('/', 'login');

require __DIR__ . '/auth.php';
Route::redirect('/login', 'awoi/login');

Route::get('change-language/{langcode}', [LanguageController::class, 'changeLang'])->name('change-lang');

if (env('APP_ENV') == 'prod') {
    Route::redirect('awoi/login', '/eds/login');
    Route::view('eds/login', 'eds.login')->name('eds.login.index');
    Route::get('eds/login/redirect', [EDSController::class, 'redirect'])->name('eds.login.redirect');
    Route::get('callback/id-tdi', [EDSController::class, 'callback'])->name('eds.login.callback');
}

Route::middleware(['auth:org', 'language'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('survey', [SurveyController::class, 'index'])->name('survey.index');
    Route::get('survey/{university:slug}/{survey}', [SurveyController::class, 'show'])->name('survey.show');
    Route::post('survey-entries/{university:slug}/{survey}', [SurveyEntryController::class, 'store'])->name('survey-entry.store');

    Route::get('entry', [EntryController::class, 'index'])->name('entry.index');
    Route::get('entry/{entry}/show', [EntryController::class, 'show'])->name('entry.show');
});
