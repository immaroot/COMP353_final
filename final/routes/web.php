<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', 'Auth\AdminLoginController@showAdminLoginForm');
Route::get('employer/login', 'Auth\EmployerLoginController@showEmployerLoginForm');
Route::get('job_seeker/login', 'Auth\JobSeekerLoginController@showJobSeekerLoginForm');
Route::get('employer/register', 'Auth\EmployerRegisterController@showEmployerRegisterForm');
Route::get('job_seeker/register', 'Auth\JobSeekerRegisterController@showJobSeekerRegisterForm')->name('register');

Route::post('admin/login', 'Auth\AdminLoginController@login');
Route::post('employer/login', 'Auth\EmployerLoginController@login');
Route::post('job_seeker/login', 'Auth\JobSeekerLoginController@login')->name('login');
Route::post('employer/register', 'Auth\EmployerRegisterController@createEmployer');
Route::post('job_seeker/register', 'Auth\JobSeekerRegisterController@createJobSeeker');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin.dashboard');
});

Route::group(['middleware' => 'auth:employer'], function () {
    Route::view('/employer', 'employer.dashboard');
});

Route::group(['middleware' => 'auth:job_seeker'], function () {
    Route::view('/job_seeker', 'job_seeker.dashboard');
});

