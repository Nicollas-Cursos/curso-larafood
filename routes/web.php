<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PlanController,
    DetailPlanController,
    UserController,
    CategoryController,
    ProductController,
    CategoryProductController,
    TableController,
    TenantController,
    ACL\ProfileController,
    ACL\PermissionController,
    ACL\PermissionProfileController,
    ACL\ProfilePermissionController,
    ACL\ProfilePlanController,
    ACL\PlanProfileController,
    ACL\RoleController,
    ACL\PermissionRoleController,
    ACL\RoleUserController
};
use App\Http\Controllers\Site\SiteController;

Route::prefix('admin')
    ->middleware('auth')
    ->group(function() {

        /**
         * Roles x User
         */
        Route::get('user/{id}/role/{idRole}/detach', [RoleUserController::class, 'detachRoleUser'])->name('user.role.detach');
        Route::post('user/{id}/roles', [RoleUserController::class, 'attachRolesUser'])->name('user.roles.attach');
        Route::any('user/{id}/roles/create', [RoleUserController::class, 'rolesAvailable'])->name('user.roles.available');
        Route::get('user/{id}/roles', [RoleUserController::class, 'roles'])->name('user.roles');


        /**
         * Permissions x Role
         */
        Route::get('role/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionRole'])->name('role.permission.detach');
        Route::post('role/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('role.permissions.attach');
        Route::any('role/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('role.permissions.available');
        Route::get('role/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('role.permissions');

        /**
         * Routes Roles
         */
        Route::any('roles/search', [RoleController::class, 'search'])->name('roles.search');
        Route::resource('roles', RoleController::class);

         /**
         * Routes Tenants
         */
        Route::any('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
        Route::resource('tenants', TenantController::class);

        /**
         * Routes Tables
         */
        Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
        Route::resource('tables', TableController::class);

        /**
         * Category x Product
         */
        Route::get('product/{id}/category/{idCategory}/detach', [CategoryProductController::class, 'detachCategoryProduct'])->name('product.category.detach');
        Route::post('product/{id}/categories', [CategoryProductController::class, 'attachCategoriesProduct'])->name('product.categories.attach');
        Route::any('product/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('product.categories.available');
        Route::get('product/{id}/categories', [CategoryProductController::class, 'categories'])->name('product.categories');


         /**
         * Routes Products
         */
        Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
        Route::resource('products', ProductController::class);

         /**
         * Routes Categories
         */
        Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::resource('categories', CategoryController::class);

         /**
         * Routes Users
         */
        Route::any('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('users', UserController::class);

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
        Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
        Route::get('plans/{url}/detail/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
        Route::put('plans/{url}/detail/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
        Route::get('plans/{url}/detail/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
        Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
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
        Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan');
        Route::get('/', [SiteController::class, 'index'])->name('home');
    });

/**
 * Auth Routes
 */
Auth::routes();