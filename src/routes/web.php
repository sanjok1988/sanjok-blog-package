<?php

use Illuminate\Support\Facades\Route;

Route::get('blog', function(){
    return "this is blog";
});

Route::group(['prefix' => '', 'namespace' => 'Sanjok\Blog\Http\Controllers\Admin'], function () {
    Route::get('rest', function () {
        return 1;
    });
    Route::get('test', 'DashboardController@index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Sanjok\Blog\Http\Controllers\Admin', 'middleware' => ['auth']], function () {
    Route::get('test', 'DashboardController@index');
    // Route::get('/', 'HomeController@index')->name('home');

    // // Categories
    // Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    // Route::resource('categories', 'CategoriesController');

    // // Tags
    // Route::delete('tags/destroy', 'TagsController@massDestroy')->name('tags.massDestroy');
    // Route::resource('tags', 'TagsController');

    // // Articles
    // Route::delete('articles/destroy', 'ArticlesController@massDestroy')->name('articles.massDestroy');
    // Route::resource('articles', 'ArticlesController');


});




/*
|--------------------------------------------------------------------------
| Private API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix'=>'api/v1', 'middleware' => '', 'namespace' => 'Sanjok\Blog\Http\Controllers\Api\v1'], function () {
    /*
     * Post
     */
    // $router->post('posts', 'PostController@store')->name('posts.store');
    // $router->patch('posts/{id}', 'PostController@update')->where('id', '[0-9]+')->name('posts.update');
    // $router->delete('posts/{id}', 'PostController@destroy')->where('id', '[0-9]+')->name('posts.destroy');

    /*
    * Category
    */
    Route::post('categories', 'CategoryController@store')->name('categories.store');
    Route::patch('categories/{id}', 'CategoryController@update')->where('id', '[0-9]+')->name('categories.update');
    Route::delete('categories/{id}', 'CategoryController@destroy')->where('id', '[0-9]+')->name('categories.destroy');

    /*
 * Category
 */
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('categories/{id}', 'CategoryController@show')->where('id', '[0-9]+')->name('categories.show');
    /*
     * Tag
     */
    // $router->post('tags', 'TagController@store')->name('tags.store');
    // $router->patch('tags/{id}', 'TagController@update')->where('id', '[0-9]+')->name('tags.update');
    // $router->delete('tags/{id}', 'TagController@destroy')->where('id', '[0-9]+')->name('tags.destroy');

    /**
     * Config
     */
    //$router->patch('configs', 'ConfigController@update')->name('configs.update');
});

