<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ChatController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BotManController;
// routes/web.php
use App\Http\Controllers\ChatsController;
Route::get('/chatbot', [BotManController::class, 'index']);
Route::post('/handle', [BotManController::class, 'handle']);


Route::get('/chats', [ChatsController::class, 'index']);
Route::post('/chat/send', [ChatsController::class, 'send']);
Route::post('/chat/reply', [ChatsController::class, 'reply']);
Route::get('/admin/chat', [ChatsController::class, 'adminIndex']);
Route::post('/admin/chat/reply', [ChatsController::class, 'adminReply']);

Route::middleware('auth')->group(function () {
    Route::get('/adminpannel', function () {
        return view('adminpannel');

    })->middleware(AdminMiddleware::class)->name('adminpannel');
});

Route::get('/chats', [ChatController::class, 'index']);
Route::post('/chats/send', [ChatController::class, 'send']);

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('/chat', function () {
    return view('chat');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    Route::get('/dashboard', function () {return Inertia::render('Dashboard');})->name('dashboard');




});
