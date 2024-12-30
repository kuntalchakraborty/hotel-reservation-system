<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\back\auth\AdminController;
use App\Http\Controllers\back\auth\AuthController;
use App\Http\Controllers\back\user\UserController;
use App\Http\Controllers\back\room\RoomTypeController;
use App\Http\Controllers\back\room\RoomController;
use App\Http\Controllers\back\room\ReservationController;
use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\front\auth\UserloginController;
/////////////////////////////////// FRONTEND ROUTES //////////////////////////////////////
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/login',[UserloginController::class,'index'])->name('user-login');
Route::post('/login', [UserloginController::class, 'login'])->name('user-login-post');
Route::post('/logout', [UserloginController::class, 'logout'])->name('user-logout');

Route::get('/registration',[UserloginController::class,'registration'])->name('user-registration');
Route::post('/register', [UserloginController::class, 'register'])->name('user-register');

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/our-rooms/{id}', [FrontController::class, 'rooms'])->name('our-rooms');
    Route::get('/our-rooms-filter/{id}', [FrontController::class, 'roomsfilter'])->name('our-rooms-filter');
    Route::get('/room-availability', [FrontController::class, 'getRoomAvailability'])->name('room.availability');
    Route::post('/reserve-room', [FrontController::class, 'reserveRoom'])->name('reserve-room');

    Route::get('/userdashboard', [FrontController::class, 'userdashboard'])->name('userdashboard');
    Route::put('/profile-update', [FrontController::class, 'updateProfile'])->name('profile.update');
    Route::put('/cancel-reservation/{id}', [FrontController::class, 'cancelReservation'])->name('cancel-reservation');
    Route::post('/logout', [UserloginController::class, 'logout'])->name('logout');
});
/////////////////////////////////// BACKEND ROUTES //////////////////////////////////////
Route::get('/admin-login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin-login', [AuthController::class, 'login'])->name('loginsubmit');
Route::post('/admin-logout', [AuthController::class, 'logout'])->name('admin-logout');
Route::middleware([AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    ////////////////////////////Users//////////////////////////////////////////////////
    Route::get('/user-list', [UserController::class, 'index'])->name('admin.userlist');
    Route::post('/users', [UserController::class, 'store'])->name('users.add');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

     ////////////////////////// Room Types Routes ///////////////////////////////////////
     Route::resource('/room-types', RoomTypeController::class);
     Route::post('/room-types/{id}', [RoomTypeController::class, 'destroy'])->name('room-types.distroy');
     Route::put('/room-types/{id}', [RoomTypeController::class, 'update']);

     ////////////////////////// Rooms Routes //////////////////////////////////////////
     Route::resource('/rooms', RoomController::class);

     Route::delete('room_images/{id}', [RoomController::class, 'imagedestroy'])->name('room_images.destroy');

    /////////////////////////////Reservations//////////////////////////////////////////
    Route::resource('reservations', ReservationController::class);
    Route::put('/reservation/{id}/update-status', [ReservationController::class, 'updateStatus'])->name('reservation.updateStatus');


});
