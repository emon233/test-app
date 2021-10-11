<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Package\LaravelFfmpegController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

require __DIR__ . '/auth.php';

Route::get('/test', function () {
    return view('packages.test.index');
});

Route::prefix('/package-laravel-ffmpeg')->name('package.laravel-ffmpeg.')->group(function () {
    Route::get('/index', [LaravelFfmpegController::class, 'index'])->name('index');
    Route::post('/store', [LaravelFfmpegController::class, 'store'])->name('store');
    Route::get('/show/{id}', [LaravelFfmpegController::class, 'show'])->name('show');
});
