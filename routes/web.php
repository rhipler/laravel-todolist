<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserManagementController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group( function() {

    Route::get('/', [ProjectController::class, 'index']);
    //Route::get('/home', 'HomeController@index');

    //project
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/project', [ProjectController::class, 'store']);
    Route::get('/project/{projectid}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/project/{projectid}', [ProjectController::class, 'update']);
    Route::delete('/project/{projectid}', [ProjectController::class, 'destroy']);


    //tasks
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('tasks', [TaskController::class, 'store']);
    Route::get('tasks/create/{projectid}', [TaskController::class, 'create'])->name('task.create');
    Route::get('tasks/{taskid}', [TaskController::class, 'show'])->name('task.show');
    Route::put('tasks/{taskid}', [TaskController::class, 'update']);
    Route::delete('tasks/{taskid}', [TaskController::class, 'destroy']);
    Route::get('tasks/{taskid}/edit', [TaskController::class,'edit'])->name('task.edit');
    Route::get('/project/{projectid}/tasks', [TaskController::class, 'listTasks'])->name('tasks.list');

    Route::post('tasks/{taskid}/addtime', [TaskController::class, 'addTime']);
    Route::delete('tasks/time/{timeid}', [TaskController::class, 'deleteTime']);

    Route::post('tasks/{taskid}/comment', [TaskController::class, 'addComment']);
    Route::delete('tasks/comment/{commentid}', [TaskController::class, 'deleteComment']);
});

Route::middleware(['auth','can:manageusers' ])->group( function() {
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
    Route::post('/users', [UserManagementController::class, 'store']);
    Route::get('/users/{userid}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/users/{userid}', [UserManagementController::class, 'update']);
    Route::delete('/users/{userid}', [UserManagementController::class, 'destroy']);
});

require __DIR__.'/auth.php';
