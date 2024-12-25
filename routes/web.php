<?php

use App\Http\Controllers\AddonController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\Sidebar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportingController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
	Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
	// Route::get('dashboard', function () {
	// 	return view('dashboard');
	// })->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('/user-management', [UserManagement::class, 'index'])->name('user-index');
	Route::get('/add-user-management', [UserManagement::class, 'add_user_management'])->name('add-user-management');
	Route::post('/insert-user-management', [UserManagement::class, 'insert_user_management'])->name('insert-user-management');
	Route::get('/delete-user-management', [UserManagement::class, 'delete_user_management'])->name('delete-user-management');
	
	////Customer Register
	Route::get('/customer-management', [UserManagement::class, 'customer_index'])->name('customer-index');
	Route::post('/add-customer-user-management', [UserManagement::class, 'add_customer_user_management'])->name('add-customer-user-management');


	////menus and category
	Route::get('/menus-management', [MenusController::class, 'index'])->name('menus-index');
	Route::get('/add-menus-management', [MenusController::class, 'add_product'])->name('add-product');
	Route::post('/insert-menus-management', [MenusController::class, 'insert_product'])->name('insert-product');
	Route::get('/delete-menus-management', [MenusController::class, 'delete_product'])->name('delete-product');
	Route::get('/update_sales-menus-management', [MenusController::class, 'update_on_sales_product'])->name('update-on-sales-product');
	Route::get('/update-sales-out-menus-management', [MenusController::class, 'update_sales_out_product'])->name('update-sales-out-product');

	Route::get('/category-management', [CategoryController::class, 'index'])->name('category-index');
	Route::get('/add-category-management', [CategoryController::class, 'add_category'])->name('add-category');
	Route::post('/insert-category-management', [CategoryController::class, 'insert_category'])->name('insert-category');
	Route::get('/delete-category-management', [CategoryController::class, 'delete_category'])->name('delete-category');

	////Add on
	Route::get('/menusaddon-management', [AddonController::class, 'index'])->name('menusaddon-index');
	Route::get('/add-menusaddon-management', [AddonController::class, 'add_menusaddon'])->name('add-menusaddon');
	Route::post('/insert-menusaddon-management', [AddonController::class, 'insert_menusaddon'])->name('insert-menusaddon');
	Route::get('/delete-menusaddon-management', [AddonController::class, 'delete_menusaddon'])->name('delete-menusaddon');

	//order management
	Route::get('/order-management', [OrderController::class, 'index'])->name('order-management-index');
	Route::get('/history-management', [OrderController::class, 'history_index'])->name('history-management-index');
	Route::get('/view-order-management', [OrderController::class, 'view_details'])->name('view-order-management');
	Route::get('/update-prepare-order-management', [OrderController::class, 'update_prepare_order_management'])->name('update-prepare-order-management');
	Route::get('/update-deliver-order-management', [OrderController::class, 'update_deliver_order_management'])->name('update-deliver-order-management');
	Route::get('/update-complete-order-management', [OrderController::class, 'update_complete_order_management'])->name('update-complete-order-management');

	Route::get('/reporting', [ReportingController::class, 'index'])->name('reporting-index');
	Route::get('/reporting-datatable', [ReportingController::class, 'reporting_datatable'])->name('reporting_datatable');


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

	Route::get('/logout', [SessionsController::class, 'destroy'])->name('destroy');
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/main-menus', [MainController::class, 'main_menus'])->name('main_menus');
Route::post('/add-cart', [MainController::class, 'add_cart'])->name('add_cart')->middleware('auth');
Route::post('/order-qty', [MainController::class, 'order_qty'])->name('order-qty');
Route::post('/remove-order', [MainController::class, 'remove_order'])->name('remove-order');
Route::get('/display-cart', [MainController::class, 'display_cart'])->name('display_cart');
Route::get('/display-delivery', [MainController::class, 'display_delivery'])->name('display_delivery');


Route::post('/update-cart-quantity', [MainController::class, 'updateQuantity'])->name('update-cart-quantity');
Route::post('/remove-cart-item', [MainController::class, 'removeItem'])->name('remove-cart-item');


Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store'])->name('store');
Route::get('/login', [SessionsController::class, 'create']);
Route::post('/session', [SessionsController::class, 'store']);
Route::get('/login/forgot-password', [ResetController::class, 'create']);
Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

Route::get('/add-payment', [MainController::class, 'add_payment'])->name('add-payment');
Route::post('/order-payment/{id}', [MainController::class, 'order_payment'])->name('order-payment');


Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

Route::get('/session', function () {
	if (Auth::check()) {
		Auth::logout();
	}

	Session::flush();
	session()->regenerate();
	return redirect()->route('login');
});

Route::get('/activate/{token}', function ($token) {
	$user = User::where('activation_token', $token)->first();


	if (!$user) {
		return redirect()->route('login')->withErrors('Invalid activation link.');
	}

	// Set the user’s email as verified and clear the activation token
	$user->email_verified_at = now();
	$user->status = 1;
	$user->activation_token = null;
	$user->save();
	return view('session/login-session')->with('status', 'Your account has been activated and you are now logged in.');
})->name('activation');

Route::get('/session/check', function () {
	return auth()->check() ? response()->json(['status' => 'active']) : abort(401);
})->name('session.check');
