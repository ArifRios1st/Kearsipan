<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LetterInController;
use App\Http\Controllers\Admin\LetterOutController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ServicerController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\UserVerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', [UserVerificationController::class,'approve'])->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class,'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class,'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class,'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Servicer
    Route::delete('servicers/destroy', [ServicerController::class,'massDestroy'])->name('servicers.massDestroy');
    Route::resource('servicers', ServicerController::class);

    // Letters In
    Route::delete('letter-ins/destroy', [LetterInController::class,'massDestroy'])->name('letter-ins.massDestroy');
    Route::post('letter-ins/media', [LetterInController::class,'storeMedia'])->name('letter-ins.storeMedia');
    Route::post('letter-ins/ckmedia', [LetterInController::class,'storeCKEditorImages'])->name('letter-ins.storeCKEditorImages');
    Route::resource('letter-ins', LetterInController::class);

    // Letters Out
    Route::delete('letter-outs/destroy', [LetterOutController::class,'massDestroy'])->name('letter-outs.massDestroy');
    Route::post('letter-outs/media', [LetterOutController::class,'storeMedia'])->name('letter-outs.storeMedia');
    Route::post('letter-outs/ckmedia', [LetterOutController::class,'storeCKEditorImages'])->name('letter-outs.storeCKEditorImages');
    Route::resource('letter-outs', LetterOutController::class);

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class,'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class,'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class,'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class,'destroy'])->name('password.destroyProfile');
    }
});
