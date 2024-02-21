<?php

use App\Http\Controllers\VideoController;
use App\Models\Video;
use Carbon\Carbon;
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
    return view('welcome');
});

Route::get('/videos/{id}', [VideoController::class, 'show']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/prova', function () {
    Video::create([
       'title' => 'Ubuntu 101',
        'description' => '# Here description',
        'url' => 'https://www.youtube.com/watch?v=12345',
        'published_at' => Carbon::parse('December 13, 2020'),
        'previous' => null,
        'next' => null,
        'series_id' => 1
    ]);
});

