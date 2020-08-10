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

        Route::get('/', 'DashboardController@show');

        Route::get('job_posts', 'JobPostController@index');
        Route::get('job_posts/create', 'JobPostController@create');
        Route::post('job_posts', 'JobPostController@store');
        Route::get('job_posts/{job_id}', 'JobPostController@show');
        Route::get('job_posts/{job_id}/edit/', 'JobPostController@edit');
        Route::put('job_posts/{job_id}', 'JobPostController@update');
        Route::delete('job_posts/{job_id}', 'JobPostController@destroy');
        Route::get('job_posts/{job_id}/remove', 'JobPostController@remove');

        Route::get('employees', 'EmployeeController@index');
        Route::post('employees', 'EmployeeController@store');
        Route::get('employees/create', 'EmployeeController@create');
        Route::delete('employees/{id}', 'EmployeeController@destroy');

        Route::get('payments', 'PaymentsController@index');
        Route::get('payments/methods', 'PaymentMethodsController@index');
        Route::get('payments/methods/{id}/edit', 'PaymentMethodsController@edit');
        Route::put('payments/methods/{id}', 'PaymentMethodsController@update');
        Route::delete('payments/methods/{id}', 'PaymentMethodsController@destroy');
        Route::get('payments/preference', 'PaymentMethodsController@showPreference');
        Route::put('payments/preference', 'PaymentMethodsController@updatePreference');

        Route::get('account', 'CompanyAccountController@index');
        Route::get('account/upgrade', 'CompanyAccountController@upgrade');
        Route::get('account/profile/edit', 'CompanyAccountController@edit');
        Route::put('account/profile/edit', 'CompanyAccountController@update');
        Route::get('account/profile/edit_level', 'CompanyAccountController@editMembership');
        Route::put('account/profile/edit_level', 'CompanyAccountController@updateMembership');

        Route::get('applications', 'ApplicationsController@summary');
        Route::get('applications/{post_id}', 'ApplicationsController@index');
        Route::get('applications/{post_id}/{application_id}', 'ApplicationsController@show');
        Route::put('applications/{post_id}/{application_id}', 'ApplicationsController@update');

        Route::get('view_profile/{job_id}', 'JobSeekerProfileController@show');
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


        Route::get('/', 'DashboardController@show');


        Route::get('jobPostings', 'JobPostingsController@index');
        Route::get('apply/{id}', 'ApplyJobController@create');

        //Route::get('/', function() {
        //    return redirect('job_seeker/job_posts');
        //});

        Route::get('job_posts', 'JobPostController@index');
        Route::get('job_posts/{post_id}', 'JobPostController@show');

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



