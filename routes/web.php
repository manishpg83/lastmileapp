<?php

use App\Http\Controllers\UploadController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\Security;
use App\Livewire\Admin\User\UserForm;
use App\Livewire\Admin\User\UserList;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/security', Security::class)->name('security');

    Route::get('/users', UserList::class)->name('users.index');
    Route::get('/users/create', UserForm::class)->name('users.create');
    Route::get('/users/{user}/edit', UserForm::class)->name('users.edit');
    Route::get('/drivers/{driver}/logs', \App\Livewire\Admin\Driver\DriverLogList::class)->name('drivers.logs');

    Route::get('/uploads', [UploadController::class, 'index'])->name('uploads.index');
    Route::post('/uploads', [UploadController::class, 'store'])->name('uploads.store');

    Route::get('/reasons', \App\Livewire\Admin\Reasons\ReasonsList::class)->name('reasons.index');
    Route::get('/notifications', \App\Livewire\Admin\Notifications\NotificationHub::class)->name('notifications.index');
    Route::get('/settings', \App\Livewire\Admin\Settings\Settings::class)->name('settings.index');

    Route::get('/deliveries', \App\Livewire\Admin\Delivery\DeliveryList::class)->name('deliveries.index');
    Route::get('/deliveries/create', \App\Livewire\Admin\Delivery\DeliveryForm::class)->name('deliveries.create');
    Route::get('/deliveries/{delivery}/edit', \App\Livewire\Admin\Delivery\DeliveryForm::class)->name('deliveries.edit');

    Route::get('/reports/master', \App\Livewire\Admin\Reports\MasterReport::class)->name('reports.master');
    Route::get('/reports/driver-wise', \App\Livewire\Admin\Reports\DriverWiseReport::class)->name('reports.driver-wise');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    })->name('logout');
});
use App\Http\Controllers\Controller;

Route::get('/', [Controller::class, 'index'])->name('index');