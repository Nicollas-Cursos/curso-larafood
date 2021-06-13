<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PlanController,
    ACL\ProfileController,
    ACL\PermissionController,
    ACL\PermissionProfileController,
    ACL\ProfilePermissionController
};

Route::prefix('admin')
    ->group(function() {

        /**
         * Permissions x Profile
         */
        Route::get('permission/{id}/profile/{idProf}/detach', [ProfilePermissionController::class, 'detachProfilePermission'])->name('permission.profile.detach');
        Route::post('permission/{id}/profiles', [ProfilePermissionController::class, 'attachProfilePermission'])->name('permission.profiles.attach');
        Route::any('permission/{id}/profiles/create', [ProfilePermissionController::class, 'profilesAvailable'])->name('permission.profiles.available');
        Route::get('permission/{id}/profiles', [ProfilePermissionController::class, 'profiles'])->name('permission.profiles');
        /**
         * Profile x Permissions
         */
        Route::get('profile/{id}/permission/{idPerm}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profile.permission.detach');
        Route::post('profile/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profile.permissions.attach');
        Route::any('profile/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profile.permissions.available');
        Route::get('profile/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profile.permissions');

        /**
         * Routes Permissions
         */
        Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
        Route::resource('permissions', PermissionController::class);

        /**
         * Routes Profiles
         */
        Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
        Route::resource('profiles', ProfileController::class);

        /**
         * Routes Details Plans
         */
        Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
        Route::put('plans/{url}/update', [PlanController::class, 'update'])->name('plans.update');
        Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
        Route::delete('plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
        Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
        Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
        Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
        
        Route::get('/', [PlanController::class, 'index'])->name('admin.index');

    });


Route::get('/', function () {
    return view('welcome');
});
