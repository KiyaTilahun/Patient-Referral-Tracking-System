<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\SmsController;
use App\Livewire\Admin\Adduser;
use App\Livewire\Admin\AllReferrals;
use App\Livewire\Admin\Department\AddIndex;
use App\Livewire\Admin\Department\DepIndex;
use App\Livewire\Admin\Department\ServiceIndex;
use App\Livewire\Admin\Departmentlist;
use App\Livewire\Admin\Holidaylist;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\Users\DeletedUsers;
use App\Livewire\Admin\Users\UserEdit;
use App\Livewire\Admin\Users\UserIndex;
use App\Livewire\Dashboard;
use App\Livewire\EditPassword;
use App\Livewire\EditProfile;
use App\Livewire\Hospital\Center\CenterIndex;
use App\Livewire\Hospital\Inbound\InboundDate;
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



Route::middleware(['auth', 'role:superadmin', 'verified'])
    ->group(function () {
        Route::get('/pending', PendingIndex::class)->name('pending');
        Route::get('/centers/all', CenterIndex::class)->name('centers.all');
        Route::get('/rolepermission', RpIndex::class)->name('rolepermission');
        Route::get('/departmentlist', Departmentlist::class)->name('departmentlist');   //alldepartment
        Route::get('/holidaylist', Holidaylist::class)->name('holidaylist');
        Route::get('/allreferrals', AllReferrals::class)->name('allreferrals');
    });
Route::middleware(['auth', 'role:admin|superadmin', 'verified'])
    ->group(function () {
        
        Route::get('/deletedusers', DeletedUsers::class)->name('deletedusers');
        Route::get('/department', DepIndex::class)
            ->name('department');
        Route::get('/department/add', AddIndex::class)
            ->name('department.add');
        Route::get('/department/services', ServiceIndex::class)
            ->name('department.services');
    });

    // settings 
    Route::get('/settings', Settings::class)->name('settings')->middleware(['auth', 'verified']);
Route::get('/adduser', Adduser::class)
    ->middleware(['auth', 'role:admin|superadmin', 'verified'])
    ->name('adduser');
Route::get('/edituser/{id}', UserEdit::class)
    ->middleware(['auth', 'role:superadmin', 'verified'])
    ->name('edituser');

Route::get('/users', UserIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('allusers');



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
Route::get('/hospital/inbound/{date}', InboundDate::class)
    ->middleware(['auth', 'verified'])
    ->name('hospital.inbound.date');
Route::get('/hospital/referral/{type}/{card_number}/date/{date}', ReferralDetail::class)
    ->middleware(['auth', 'verified'])
    ->name('hospital.referral');
Route::get('/editprofile', EditProfile::class)
    ->middleware(['auth', 'verified'])
    ->name('editprofile');
Route::get('/editpassowrd', EditPassword::class)
    ->middleware(['auth', 'verified'])
    ->name('editpassword');
Route::get('generate/{id}', [ReferrReport::class, 'create'])->name('generate');
Route::get('generate/patient/{id}/{token}', [ReferrReport::class, 'createqr'])->name('generate.patient');
Route::get('generate/referralreport/{id}/{date}', [ReferrReport::class, 'referralreport'])->name('generate.referralreport');
Route::get('generate/', [ReferrReport::class, 'demo'])->name('demo');
Route::get('/sms', [SmsController::class, 'sms'])
    ->name('sms');
Route::fallback(function () {
    return response()->view('utils.errors.404', []); // Custom 404 view
});
Route::get('/unauthorized', function () {

    return response()->view('utils.errors.401', [], 401); // View for 401 Unauthorized
})->name('unauthorized');

require __DIR__ . '/auth.php';
