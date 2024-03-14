<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OznamController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('o_nas', 'O_nasController@show')->name('home.o_nas');




    Route::group(['middleware' => ['permission', 'auth']], function() {

        Route::group(['prefix' => 'oznam_index'], function (){
            Route::get('/', 'OznamController@index')->name('oznam.oznam');

            //ajax
            Route::get('/load-more-posts', 'OznamController@loadMorePosts')->name('oznam.load-more-posts');
            Route::get('/oznam/{id}/load-more-comments', 'OznamController@loadMoreComments')->name('oznam.load-more-comments');

            Route::get('/oznam/create', 'OznamController@create')->name('oznam.create');
            Route::post('/oznam/create', 'OznamController@store')->name('oznam.store');
            Route::get('/oznam/{id}', 'OznamController@show')->name('oznam.oznamShow');
            Route::get('/oznam/edit/{id}', 'OznamController@edit')->name('oznam.oznamEdit');
            Route::put('/oznam/edit/{id}', 'OznamController@update')->name('oznam.update');
            Route::delete('/oznam/{id}', 'OznamController@destroy')->name('oznam.destroy');

            Route::post('/oznam/{id}/like', 'OznamController@likeOznam')->name('oznam.like');

            Route::get('/oznam/tag/{id}', 'TagController@indexTag')->name('oznam.tag');
            Route::post('/oznam/tag/{id}', 'TagController@associateTag')->name('oznam.associateTag');

            Route::get('/tag/create', 'TagController@tagMenu')->name('oznam.tagMenu');
            Route::post('/tag/create', 'TagController@createTag')->name('oznam.createTag');
            Route::get('/tag/delete', 'TagController@tagMenuDelete')->name('oznam.tagMenuDelete');
            Route::delete('/tag/delete', 'TagController@deleteTag')->name('oznam.deleteTag');

            Route::post('/oznam/{id}', 'OznamController@storeComment')->name('oznam.comment');
            Route::delete('/oznam/comment/{id}', 'OznamController@destroyComment')->name('oznam.CommentDestroy');
            Route::put('/oznam/comments/{id}', 'OznamController@updateComment')->name('oznam.CommentUpdate');

        });

        Route::group(['prefix' => 'womac'], function () {
            Route::get('/', 'WomacController@show')->name('home.womac');
            Route::post('/create/{id_operation}', 'WomacController@create')->name('womac.create');
            Route::get('/womac-data/{id_womac}', 'WomacController@getWomacData')->name('womac.getWomac');
            Route::delete('/delete/{id_womac}', 'WomacController@deleteWomac')->name('womac.delete');
            Route::get('/filter', 'WomacController@filter')->name('womac.filter');
        });

        Route::group(['prefix' => 'export'], function () {
            Route::get('/', 'ExportController@show')->name('export.export');
            Route::get('/operacia/{id_operacie}', 'ExportController@showOperacia')->name('export.operacia');
            Route::get('/filter', 'ExportController@filter')->name('export.filter');
            Route::post('/export-data', 'ExportController@exportToExcel')->name('export.toExcel');
        });
    });



    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });





    /**
     * Logout Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/password-change/show', 'UsersController@passwordChangeShow')->name('passwordChange.show');
        Route::post('/password-change/update', 'UsersController@passwordChange')->name('passwordChange.change');
    });

    Route::group(['middleware' => ['auth', 'permission']], function() {


        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });


        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
});
