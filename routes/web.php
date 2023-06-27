<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\OrganizationController;
// use App\Http\Controllers\OrganizationController;

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

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get("organizations","OrganizationController@index")->name("organizations.index");
    Route::get("getOrganizations","OrganizationController@getOrganizations")->name("organizations.getall");
    Route::get("organizations/create","OrganizationController@create")->name("organizations.create");
    Route::post("organizations/store","OrganizationController@store")->name("organizations.store");

    Route::get("organizations/edit/{id}","OrganizationController@edit")->name("organizations.edit");
    Route::post("organizations/update/{id}","OrganizationController@update")->name("organizations.update");

    Route::get("organizations/delete/{id}","OrganizationController@destroy")->name("organizations.destroy");
});

// Route::get("/organizations","OrganizationController@index");


