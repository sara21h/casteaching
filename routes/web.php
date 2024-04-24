<?php

use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideosManageController;
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


Route::get('/manage/videos', [VideosManageController::class, 'index'])->middleware(['can:videos_manage_index']) -> name('manage.videos');


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })-> name('dashboard');
    Route::get('/manage/videos', [VideosManageController::class, 'index'])->middleware(['can:videos_manage_index'])
        -> name('manage.videos');
    Route::post('/manage/videos', [VideosManageController::class, 'store']);
    #Route::get('/manage/users', [UsersManageController::class, 'index'])->middleware(['can:users_manage_index'])
    #    -> name('manage.users');
});
