<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('login');
Route::get('refresh_captcha', [App\Http\Controllers\UserController::class, 'refreshCaptcha'])->name('refresh_captcha');
Route::group(['middleware'=>'guest'],function(){
Route::post('custom-login', [App\Http\Controllers\UserController::class, 'customLogin'])->name('custom-login')->middleware('throttle:2,1');
});
// Forget password
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['auth']], function () { 
// Dashboard    
Route::get('dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');


Route::get('/role', [App\Http\Controllers\Role\RoleController::class, 'role'])->name('role');

Route::get('/add_role', [App\Http\Controllers\Role\RoleController::class, 'index'])->name('add_role');

Route::post('/add_role', [App\Http\Controllers\Role\RoleController::class, 'store'])->name('add_role');

Route::get('/edit_role/{editID}', [App\Http\Controllers\Role\RoleController::class, 'edit'])->name('edit_role');

Route::put('/edit_role/{id}', [App\Http\Controllers\Role\RoleController::class, 'update'])->name('edit_role');

Route::get('/delete_role/{id}', [App\Http\Controllers\Role\RoleController::class, 'delete'])->name('delete');

Route::get('/role_permission', [App\Http\Controllers\Role\RoleController::class, 'role_permission'])->name('role_permission');


Route::post('/submit_role_permission', [App\Http\Controllers\Role\RoleController::class, 'submit_role_permission'])->name('submit_role_permission');

Route::get('/role_permission_edit/{id}', [App\Http\Controllers\Role\RoleController::class, 'role_permission_edit'])->name('role_permission_edit');

Route::post('/update_role_permission/{id}', [App\Http\Controllers\Role\RoleController::class, 'update_role_permission'])->name('update_role_permission');

Route::post('/update_role_page_permission', [App\Http\Controllers\Role\RoleController::class, 'update_role_page_permission'])->name('update_role_page_permission');

// aaisports list
Route::get('/aaisports-list', [App\Http\Controllers\aaisports\SpoartController::class, 'index'])->name('aaisports-list');
Route::post('/aaisports-import', [App\Http\Controllers\aaisports\SpoartController::class, 'importCsv'])->name('aaisports-import');
Route::get('/update-spoarts/{id}', [App\Http\Controllers\aaisports\SpoartController::class, 'updatespoarts'])->name('update-spoarts');
Route::post('/update-aaisports-spoarts/{id}', [App\Http\Controllers\aaisports\SpoartController::class, 'updateAirports'])->name('update-aaisports-spoarts');

Route::post('/aaisports-store', [App\Http\Controllers\aaisports\SpoartController::class, 'aaisports_store'])->name('aaisports-store');
Route::get('/delete-aaisports/{id}', [App\Http\Controllers\aaisports\SpoartController::class, 'destroyaaisports'])->name('delete-aaisports');
Route::post('/update-aaisports-status/{id}', [App\Http\Controllers\aaisports\SpoartController::class, 'update_aaisports_status'])->name('update-aaisports-status');
Route::get('/aaisports-search', [App\Http\Controllers\aaisports\SpoartController::class, 'search_aaisports'])->name('aaisports-search');
// aaisports list




Route::get('signout', [App\Http\Controllers\UserController::class, 'signOut'])->name('signout');
});
