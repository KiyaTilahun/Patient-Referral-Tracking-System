<?php

use App\Http\Controllers\HospitalController;
use App\Livewire\Admin\Adduser;
use App\Livewire\Admin\Department\AddIndex;
use App\Livewire\Admin\Department\DepIndex;
use App\Livewire\Admin\Users\UserEdit;
use App\Livewire\Admin\Users\UserIndex;
use App\Livewire\Dashboard;
use App\Livewire\Hospital\Center\CenterIndex;
use App\Livewire\Hospital\Inbound\InboundIndex;
use App\Livewire\Hospital\Outbound\OutboundDate;
use App\Livewire\Hospital\Outbound\OutboundIndex;
use App\Livewire\Hospital\Pending\PendingIndex;
use App\Livewire\Hospital\Register;
use App\Livewire\Patient\PatientIndex;
use App\Livewire\Patient\ReferralDetail;
use App\Livewire\Patient\ReferralIndex;
use App\Livewire\RolePermission\RpIndex;
use App\Mail\RegisterEmail;
use App\Models\Admin\Hospital;
use App\Models\ReferrReport;
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

Route::get('/', function () {

    return redirect('/login');
});
Route::get('/registerhealth', [HospitalController::class, 'index'])->name('registerhealth');
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
Route::get('/centers/all', CenterIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('centers.all');

Route::get('/rolepermission', RpIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('rolepermission');


Route::get('/adduser', Adduser::class)
    ->middleware(['auth', 'verified'])
    ->name('adduser');
    Route::get('/edituser/{id}', UserEdit::class)
    ->middleware(['auth', 'verified'])
    ->name('edituser');

    Route::get('/users', UserIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('allusers');


Route::get('/department', DepIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('department');
Route::get('/department/add', AddIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('department.add');
Route::get('/patient/add', PatientIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('patient.add');
Route::get('/referral/add', ReferralIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('referral.add');
    Route::get('/hospital/inbound', InboundIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('hospital.inbound');
    Route::get('/hospital/outbound', OutboundIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('hospital.outbound');
    Route::get('/hospital/outbound/{date}', OutboundDate::class)
    ->middleware(['auth', 'verified'])
    ->name('hospital.outbound.date');
    Route::get('/hospital/referral/{card_number}/date/{date}', ReferralDetail::class)
    ->middleware(['auth', 'verified'])
    ->name('hospital.referral');
Route::get('generate/{id}',[ReferrReport::class,'create'])->name('generate');



// Route::get(/rolepermission,)
// Route::get('/contact',function(){
//     Mail::to('kiyatilahun0@gmail.com')->send(new RegisterEmail('hello','12345666'));
// });

require __DIR__ . '/auth.php';
