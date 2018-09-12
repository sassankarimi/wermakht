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



//Route::get('/', function () {
//        dd(config());
//        //return view('welcome');
//    });
    Route::group(['middlware' => ['web']], function () {

        Route::group(['prefix' => 'ss', 'as' => 'wss.'], function () {
            Route::resource('photo', 'PhotoController', ['except' => ['show', 'update']]);
            Route::get('/', ['as' => 'pg', 'uses' => 'PagesController@home']);
            Route::get('edit', ['as' => 'edit', 'uses' => 'PagesController@home']);
            //Route::get('edit','PagesController@home')->name('edit');
            Route::get('cards', ['as' => 'card', 'uses' => 'CardsController@index']);
            Route::get('users/{user}', function (\App\User $user) {
                return $user;
            })->middleware('throttle');
            Route::get('event/{userId}', ['as' => 'event', 'uses' => 'CardsController@ship'])->middleware('throttle');
            Route::get('cards/{card}', ['as' => 'card_show', 'uses' => 'CardsController@show']);
            Route::post('cards/{card}/notes', ['as' => 'note_store', 'uses' => 'NotesController@store']);
            Route::get('notes/{note}/edit', ['as' => 'note_edit', 'uses' => 'NotesController@edit']);
            Route::patch('notes/{note}', ['as' => 'note_up', 'uses' => 'NotesController@update']);
//         });
//        Auth::routes();
//        Route::get('/home', 'HomeController@index')->name('home');
        });
    });

