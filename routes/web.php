<?php

use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent as Agent;

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
        return view('pages.welcome');
        /* $agent=new Agent();
        if ($agent->isMobile()) {
            // you're a mobile device
            return view('MobilePages.welcome');
        } else {
            // you're a desktop device, or something similar
            return view('pages.welcome');
        } */
    });

    Route::get('/search', function (){
        /* $agent=new Agent();
        if ($agent->isMobile()) {
            // you're a mobile device
            return \App::call('\App\Http\Controllers\MobileSearchController@search');
        //'SearchController@search')->name('search');
        } else {
            // you're a desktop device, or something similar
            return  \App::call('\App\Http\Controllers\SearchController@search');
        } */
        return  \App::call('\App\Http\Controllers\SearchController@search');
        })->name('search');


    Route::get('/details', function () {
        return view('details');
    });

    //admin
    Route::get('/admin', 'AdminController@console');



    //second design
    Route::post('autocomplete','MobileSearchController@autocomplete')->name("hint");





