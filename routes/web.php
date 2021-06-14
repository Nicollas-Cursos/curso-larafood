<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PlanController,
    DetailPlanController,
    ACL\ProfileController,
    ACL\PermissionController,
    ACL\PermissionProfileController,
    ACL\ProfilePermissionController,
    ACL\ProfilePlanController,
    ACL\PlanProfileController
};
use App\Http\Controllers\Site\SiteController;

Route::prefix('admin')
    ->middleware('auth')
    ->group(function() {

        /**
         * Profiles x Plans
         */
        Route::get('profile/{id}/plan/{idPlan}/detach', [PlanProfileController::class, 'detachPlanProfile'])->name('profile.plan.detach');
        Route::post('profile/{id}/plans', [PlanProfileController::class, 'attachPlanProfile'])->name('profile.plans.attach');
        Route::any('profile/{id}/plans/create', [PlanProfileController::class, 'plansAvailable'])->name('profile.plans.available');
        Route::get('profile/{id}/plans', [PlanProfileController::class, 'plans'])->name('profile.plans');


        /**
         * Plans x Profiles
         */
        Route::get('plan/{id}/profile/{idProf}/detach', [ProfilePlanController::class, 'detachProfilePlan'])->name('plan.profile.detach');
        Route::post('plan/{id}/profiles', [ProfilePlanController::class, 'attachProfilePlan'])->name('plan.profiles.attach');
        Route::any('plan/{id}/profiles/create', [ProfilePlanController::class, 'profilesAvailable'])->name('plan.profiles.available');
        Route::get('plan/{id}/profiles', [ProfilePlanController::class, 'profiles'])->name('plan.profiles');

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
        Route::delete('plans/{url}/detail/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
        Route::get('plans/{url}/detail/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
        Route::put('plans/{url}/detail/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
        Route::get('plans/{url}/detail/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
        Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
        Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
        Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');

        /** 
         * Route Plans
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


Route::namespace('Site')
    ->name('site.')
    ->group(function() {
        Route::get('/', [SiteController::class, 'index'])->name('home');

    });

/**
 * Auth Routes
 */
Auth::routes();