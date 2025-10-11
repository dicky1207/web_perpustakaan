<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard.index');
    Route::get('/dashboard/logs', 'Admin\DashboardController@getAuthenticateLogs')->name('dashboard.logs');

    // Profile
    Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    // Data Master
    Route::resource('/users', 'Admin\UserController');
    Route::resource('/book-types', 'Admin\BookTypeController');
    Route::resource('/books', 'Admin\BookController');
    Route::resource('/book-borrowers', 'Admin\BookUserController');
    Route::resource('/book-borrowers-history', 'Admin\BookBorrowerHistoryController');

    // Detail book on JSON
    Route::get('/book-json/{id}', 'Admin\JsonResponseController@detailBook')->name('json-book.show');

    // Detail user on JSON
    Route::get('/user-json/{id}', 'Admin\JsonResponseController@detailUser')->name('json-user.show');

    // Book borrower approved button
    Route::put('/book-approved/{id}', 'Admin\JsonResponseController@approvedBookBorrower')->name('json-book.approved');

    // Book borrower not approve button
    Route::put('/book-not-approved/{id}', 'Admin\JsonResponseController@notApproveBookBorrower')->name('json-book.not-approved');
});

Route::group(['prefix' => 'operator', 'as' => 'operator.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'Operator\DashboardController@index')->name('dashboard.index');
    Route::get('/dashboard/logs', 'Operator\DashboardController@getAuthenticateLogs')->name('dashboard.logs');

    // Profile
    Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    // Data Master
    Route::resource('/book-types', 'Operator\BookTypeController');
    Route::resource('/books', 'Operator\BookController');
    Route::resource('/book-borrowers', 'Operator\BookUserController');
    Route::resource('/book-borrowers-history', 'Operator\BookBorrowerHistoryController');

    // Detail book on JSON
    Route::get('/book-json/{id}', 'Operator\JsonResponseController@detailBook')->name('json-book.show');

    // Detail user on JSON
    Route::get('/user-json/{id}', 'Operator\JsonResponseController@detailUser')->name('json-user.show');

    // Book borrower approved button
    Route::put('/book-approved/{id}', 'Operator\JsonResponseController@approvedBookBorrower')->name('json-book.approved');

    // Book borrower not approve button
    Route::put('/book-not-approved/{id}', 'Operator\JsonResponseController@notApproveBookBorrower')->name('json-book.not-approved');
});

Route::group(['prefix' => 'anggota', 'as' => 'anggota.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'Anggota\DashboardController@index')->name('dashboard.index');
    Route::get('/dashboard/logs', 'Anggota\DashboardController@getAuthenticateLogs')->name('dashboard.logs');

    // Profile
    Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    // Menu
    Route::resource('/book-borrowers-history', 'Anggota\BookBorrowerHistoryController');

    // Store JSON
    Route::post('/book-borrowers-json', 'Anggota\JsonResponseController@store')->name('json-book-borrowers.store');

    Route::resource('/book-borrow', 'Anggota\BookBorrowController');
});

Auth::routes();

Route::middleware('auth')->group(function () {
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/home', 'HomeController@index')->name('home');
