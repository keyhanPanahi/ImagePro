<?php

use App\Http\Controllers\Admin\Image\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Membership\RoleController;
use App\Http\Controllers\Admin\Membership\PermissionController;
use App\Http\Controllers\Admin\Membership\UserController;
use App\Http\Controllers\Admin\Membership\OrganizationController;
use App\Http\Controllers\Admin\Membership\ProfileController;
use App\Http\Controllers\Admin\Sevice\SelectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return to_route('admin.dashboard');
});

Route::prefix('/admin')->middleware(['auth'])->group(function() {

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');

    //select
    // Route::prefix('/select')->group(function(){
    //     Route::post('/select-user',[SelectController::class , 'selectUser'])->name('admin.select.selectUser');
    //     Route::post('/select-organization',[SelectController::class , 'selectOrganization'])->name('admin.select.selectOrganization');
    // });

    //dashboard

    //membership
    // Route::prefix('/membership')->group(function() {

        // profile
        Route::prefix('profile')->group(function(){
            Route::get('/',[ProfileController::class , 'profile'])->name('admin.membership.profile');
            Route::put('/change-avatar',[ProfileController:: class , 'changeAvatar'])->name('admin.membership.profile.changeAvatar');
            Route::put('/change-profile-information',[ProfileController:: class , 'changeProfileInformation'])->name('admin.membership.profile.changeProfileInformation');
        });
        Route::prefix('image')->group(function(){
            Route::post('/',[ImageController::class , 'image'])->name('admin.membership.image');
        });

        //user
        // Route::prefix('/user')->group(function() {
        //     Route::get('/',[UserController::class , 'index'])->name('admin.membership.user.index');
        //     Route::get('/create',[UserController::class , 'create'])->name('admin.membership.user.create');
        //     Route::post('/store',[UserController::class , 'store'])->name('admin.membership.user.store');
        //     Route::get('/show/{user}',[UserController::class , 'show'])->name('admin.membership.user.show');
        //     Route::get('/edit/{user}',[UserController::class , 'edit'])->name('admin.membership.user.edit');
        //     Route::put('/update/{user}',[UserController::class , 'update'])->name('admin.membership.user.update');
        //     Route::post('/destroy',[UserController::class , 'destroy'])->name('admin.membership.user.destroy');
        //     Route::post('/status',[UserController::class , 'status'])->name('admin.membership.user.status');
        // });

        //organization
        // Route::prefix('/organization')->group(function() {
        //     Route::get('/',[OrganizationController::class, 'index'])->name('admin.membership.organization.index');
        //     Route::get('/create',[OrganizationController::class, 'create'])->name('admin.membership.organization.create');
        //     Route::post('/store',[OrganizationController::class, 'store'])->name('admin.membership.organization.store');
        //     Route::get('/show/{organization}',[OrganizationController::class, 'show'])->name('admin.membership.organization.show');
        //     Route::get('/edit/{organization}',[OrganizationController::class, 'edit'])->name('admin.membership.organization.edit');
        //     Route::put('/update/{organization}',[OrganizationController::class, 'update'])->name('admin.membership.organization.update');
        //     Route::post('/destroy',[OrganizationController::class , 'destroy'])->name('admin.membership.organization.destroy');
        //     Route::post('/status',[OrganizationController::class , 'status'])->name('admin.membership.organization.status');
        // });

        // //role
        // Route::prefix('/role')->group(function() {
        //     Route::get('/',[RoleController::class,'index'])->name('admin.membership.role.index');
        //     Route::get('/create',[RoleController::class,'create'])->name('admin.membership.role.create');
        //     Route::post('/store',[RoleController::class,'store'])->name('admin.membership.role.store');
        //     Route::get('/edit/{role}',[RoleController::class,'edit'])->name('admin.membership.role.edit');
        //     Route::put('/update/{role}',[RoleController::class,'update'])->name('admin.membership.role.update');
        //     Route::post('/destroy',[RoleController::class,'destroy'])->name('admin.membership.role.destroy');
        // });

        //permission
        // Route::prefix('/permission')->group(function() {
        //     Route::get('/',[PermissionController::class,'index'])->name('admin.membership.permission.index');
        //     Route::get('/create',[PermissionController::class,'create'])->name('admin.membership.permission.create');
        //     Route::post('/store',[PermissionController::class,'store'])->name('admin.membership.permission.store');
        //     Route::get('/edit/{permission}',[PermissionController::class,'edit'])->name('admin.membership.permission.edit');
        //     Route::put('/update/{permission}',[PermissionController::class,'update'])->name('admin.membership.permission.update');
        //     Route::post('/destroy',[PermissionController::class,'destroy'])->name('admin.membership.permission.destroy');
        // });

    // });

});
