<?php

use App\Http\Controllers\HospitalController;
use App\Livewire\Dashboard;
use App\Livewire\Hospital\Center\CenterIndex;
use App\Livewire\Hospital\Pending\PendingIndex;
use App\Livewire\Hospital\Register;
use App\Mail\RegisterEmail;
use App\Models\Admin\Hospital;
use Illuminate\Support\Facades\Mail;
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
    ->middleware(['auth', 'verified','role:superadmin'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


    // live wire routes

    Route::get('/pending', PendingIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('pending');
    Route::get('/centers/all', CenterIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('centers.all');

    // Route::get(/rolepermission,)
// Route::get('/contact',function(){
//     Mail::to('kiyatilahun0@gmail.com')->send(new RegisterEmail('hello','12345666'));
// });

require __DIR__.'/auth.php';
