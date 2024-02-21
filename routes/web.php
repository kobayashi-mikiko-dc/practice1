<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Lib\MyFunction;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

Route::get('/show',[Controller::class, 'show']);

Route::get('/register', function () { 
    return view('register', [MyFunction::class, 'yearSelect'])->name('register.yearSelect');
    return view('register', [MyFunction::class, 'monthSelect'])->name('register.monthSelect');
    return view('register', [MyFunction::class, 'daySelect'])->name('register.daySelect');
});

require __DIR__.'/auth.php';
