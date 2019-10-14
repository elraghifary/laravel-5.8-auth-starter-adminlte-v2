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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['role:superadmin|admin']], function () {
        // Role Routes
        Route::resource('/role', 'RoleController')->except([
            'create', 'show', 'edit', 'update'
        ]);
        Route::get('/role/permissions/{id}', 'RoleController@permissions')->name('role.permissions');
        Route::put('/role/permissions/{role}', 'RoleController@setPermission')->name('role.set_permission');
        Route::get('/roles', 'RoleController@getData')->name('role.getData');
        
        // Permission Routes
        Route::resource('/permission', 'PermissionController')->except([
            'create', 'show', 'edit', 'update'
        ]);
        Route::get('/permissions', 'PermissionController@getData')->name('permission.getData');

        // User Routes
        Route::resource('/user', 'UserController');
        Route::get('/user/roles/{user}', 'UserController@roles')->name('user.roles');
        Route::put('/user/roles/{user}', 'UserController@setRole')->name('user.set_role');
        Route::get('/users', 'UserController@getData')->name('user.getData');
    });
});
