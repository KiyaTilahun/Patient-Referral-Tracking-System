<?php

use App\Http\Controllers\HospitalController;
use App\Livewire\Dashboard;
use App\Livewire\Hospital\Pending\PendingIndex;
use App\Livewire\Hospital\Register;
use App\Models\Admin\Hospital;
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

Route::get('/', function(){

    return redirect('/login');
});
Route::get('/registerhealth',[HospitalController::class,'index'])->name('registerhealth');
// Route::get('/registerhealth',Register::class)->name('registerhealth');


Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


    // live wire routes

    Route::get('/pending', PendingIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('pending');

require __DIR__.'/auth.php';
