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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/mockup', function () {
    return view('video_mockup', [
        'title' => 'Title',
        'url' => 'https://www.youtube.com/embed/ofSbYUEml4c?controls=0',
        'description' => 'DDESCRIPTION'
    ]);
});

