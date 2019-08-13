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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function()
{
    Route::match(['get','post'],'klasy', 'SchoolroomController@index');
    Route::match(['get','post'],'klasy/dodaj', 'SchoolroomController@create');
    Route::match(['get','post'],'klasy/edytuj/{id}', 'SchoolroomController@edit');
    Route::match(['get','post'],'klasy/usun/{id}', 'SchoolroomController@delete');

    Route::match(['get','post'],'nauczyciele', 'TeacherController@index');
    Route::match(['get','post'],'nauczyciele/dodaj', 'TeacherController@create');
    Route::match(['get','post'],'nauczyciele/edytuj/{id}', 'TeacherController@edit');
    Route::match(['get','post'],'nauczyciele/usun/{id}', 'TeacherController@delete');

    Route::match(['get','post'],'pokoje', 'RoomController@index');
    Route::match(['get','post'],'pokoje/dodaj', 'RoomController@create');
    Route::match(['get','post'],'pokoje/edytuj/{id}', 'RoomController@edit');
    Route::match(['get','post'],'pokoje/usun/{id}', 'RoomController@delete');

    Route::match(['get','post'],'przedmioty', 'SubjectController@index');
    Route::match(['get','post'],'przedmioty/dodaj', 'SubjectController@create');
    Route::match(['get','post'],'przedmioty/edytuj/{id}', 'SubjectController@edit');
    Route::match(['get','post'],'przedmioty/usun/{id}', 'SubjectController@delete');

    Route::match(['get','post'],'uzytkownicy', 'UserController@index');
    Route::match(['get','post'],'uzytkownicy/dodaj', 'UserController@create');
    Route::match(['get','post'],'uzytkownicy/edytuj/{id}', 'UserController@edit');
    Route::match(['get','post'],'uzytkownicy/usun/{id}', 'UserController@delete');

    Route::match(['get','post'],'ustawienia', 'SettingsController@index');

    Route::match(['get','post'],'rozklad/{schoolroom_id}/{active_week}', 'SheduleController@index');
    Route::match(['get','post'],'rozklad/dodaj/{schoolroom_id}/{active_week}', 'SheduleController@create');
    Route::match(['get','post'],'rozklad/edytuj/{schoolroom_id}/{shedule_week}/{shedule_id}', 'SheduleController@edit');
    Route::match(['get','post'],'rozklad/usun/{schoolroom_id}/{shedule_week}/{shedule_id}', 'SheduleController@delete');
});

Route::match(['get','post'],'resetuj-haslo', 'Auth\LoginController@passwordReset');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/index/{schoolroom_id}/{active_week}', 'HomeController@index')->name('home');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});
