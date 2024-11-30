<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/setting/dropdown-role',[Staff::class, 'dropdown_role'])->name('dropdown-role');
//Route::post('/setting/add-staff', [Staff::class, 'add_staff'])->name('add-staff');
//Route::get('/setting/get_roles_user', [Staff::class,'get_roles_user'])->name('get-roles-user');
//Route::get('/staff-table-view', [Staff::class, 'staff_table_view'])->name('staff-table-view');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');
	
    Route::get('/user-management', [UserManagement::class, 'index']);
	Route::post('/add-staff', [UserManagement::class, 'add_staff'])->name('add-staff');

	////menus and category
    Route::get('/menus-management', [MenusController::class, 'index'])->name('menus-index');
    Route::get('/add-menus-management', [MenusController::class, 'add_product'])->name('add-product');
    Route::post('/insert-menus-management', [MenusController::class, 'insert_product'])->name('insert-product');
    Route::get('/delete-menus-management', [MenusController::class, 'delete_product'])->name('delete-product');
	Route::get('/category-management', [CategoryController::class, 'index']);
	Route::get('/add-category-management', [CategoryController::class, 'add_category'])->name('add-category');
    Route::post('/add-category-management', [CategoryController::class, 'insert_category'])->name('insert-category');


	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');