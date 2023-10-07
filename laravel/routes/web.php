<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Models\Project;
use App\Models\User;

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

Route::resource('project', ProjectController::class);

Route::get('/project', [ProjectController::class, 'index'])->name('project');

Route::get('/project/provider/{userId}', [ProjectController::class, 'by_ip'])->name('project.by_ip');

Route::get('/project/{id}/apply/', [ProjectController::class, 'apply'])->name('project.apply');

Route::post('/project/{id}/apply/', [ProjectController::class, 'store_application'])->name('project.apply');

Route::get('/students', [UserController::class, 'students'])->name('students');

Route::get('/student/{id}', [UserController::class, 'student'])->name('students');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard')->with('ips', User::users_by_type('ip'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/attributes', [ProfileController::class, 'update_attributes'])->name('profile.update_attributes');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
