<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatroomController;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('/', function () {
    return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        }
        )->name('dashboard');
    Route::get('/chat', function () {
            return Inertia::render('Chat/container');
        }
        )->name('chat');
    });


Route::middleware(['auth:sanctum', 'verified'])->resource('/chatrooms', ChatroomController::class);
Route::middleware(['auth:sanctum', 'verified'])->put('/chatrooms/{chatroom_id}/add_admin', [ChatroomController::class, 'addAdmin']);
Route::middleware(['auth:sanctum', 'verified'])->put('/chatrooms/{chatroom_id}/block_user', [ChatroomController::class, 'blockUser']);
Route::middleware(['auth:sanctum', 'verified'])->put('/chatrooms/{chatroom_id}/add_user', [ChatroomController::class, 'addUser']);
Route::middleware(['auth:sanctum', 'verified'])->resource('/chatrooms/{chatroom_id}/messages', MessageController::class);