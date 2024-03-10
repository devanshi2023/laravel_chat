<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MailController;
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


//All Routes Of Employee
$employeecontroller = EmployeeController::class;
Route::get('/', [$employeecontroller, 'index'])->name('emp.index')->middleware('auth');
//user login
Route::get('/user/login', [$employeecontroller, 'login'])->name('user.login')->middleware('alreadyLoggedIn');
//user login verify
Route::post('/user/verify', [$employeecontroller, 'verify'])->name('user.verify');
//user register page outside dashboard
Route::get('/user/register', [$employeecontroller, 'register'])->name('user.register')->middleware('alreadyLoggedIn');
//emp store dashboard
Route::post('/user/add', [$employeecontroller, 'add'])->name('user.add');
//chats
Route::get('/user/chat/{userId}', [$employeecontroller, 'showChat'])->name('user.chat')->middleware('auth');
//send message
Route::post('/send-message', [$employeecontroller, 'sendMessage'])->name('sendMessage');
//new message
Route::post('getConversations', [$employeecontroller, 'getConversations'])->name('getConversations');
//logout
Route::get('/logout', [$employeecontroller, 'logout'])->name('emp.logout')->middleware('auth');
// routes/web.php
Route::get('/unread-message-count', [$employeecontroller, 'getUnreadMessageCount'])->name('unread-message-count');
