<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//All Employer Routes
Route::group(['prefix' => 'employer'], function () {

    Route::get('login', 'Auth\EmployerLoginController@showEmployerLoginForm');
    Route::post('login', 'Auth\EmployerLoginController@login');

    Route::get('register', 'Auth\EmployerRegisterController@showEmployerRegisterForm');
    Route::post('register', 'Auth\EmployerRegisterController@createEmployer');

    //Authenticated Routes
    Route::group(['middleware' => 'auth:employer', 'namespace' => 'Employer'], function () {

        Route::get('/', 'DashBoardController@show');

        Route::get('job_posts', 'JobPostController@index');
        Route::get('job_posts/create', 'JobPostController@create');
        Route::post('job_posts', 'JobPostController@store');
        Route::get('job_posts/{job_id}', 'JobPostController@show');
        Route::get('job_posts/{job_id}/edit/', 'JobPostController@edit');
        Route::put('job_posts/{job_id}', 'JobPostController@update');
        Route::delete('job_posts/{job_id}', 'JobPostController@destroy');
        Route::get('job_posts/{job_id}/remove', 'JobPostController@remove');

        Route::get('profile', 'ProfileController@show');
        Route::get('profile/edit', 'ProfileController@edit');
        Route::post('profile/edit', 'ProfileController@update');

        Route::get('employees/create', 'EmployeeController@create');
        Route::post('employees', 'EmployeeController@store');
        Route::get('employees', 'EmployeeController@index');
    });
});

//All JobSeeker Routes
Route::group(['prefix' => 'job_seeker'], function () {

    Route::get('login', 'Auth\JobSeekerLoginController@showJobSeekerLoginForm');
    Route::post('login', 'Auth\JobSeekerLoginController@login')->name('login');

    Route::get('register', 'Auth\JobSeekerRegisterController@showJobSeekerRegisterForm')->name('register');
    Route::post('register', 'Auth\JobSeekerRegisterController@createJobSeeker');

    //Authenticated Routes
    Route::group(['middleware' => 'auth:job_seeker', 'namespace' => 'JobSeeker'], function () {

        Route::view('/', 'job_seeker.dashboard');

    });
});

//All Admin Routes
Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Auth\AdminLoginController@showAdminLoginForm');
    Route::post('login', 'Auth\AdminLoginController@login');

    Route::get('register', 'Auth\AdminRegisterController@showAdminRegisterForm');
    Route::post('register', 'Auth\AdminRegisterController@createAdmin');

    //Authenticated Routes
    Route::group(['middleware' => 'auth:admin', 'namespace' => 'Admin'], function () {
        Route::view('/', 'admin.dashboard');
    });
});



