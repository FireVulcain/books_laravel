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

Route::get('/', 'FrontController@index')->name('home');

Route::get('/book/{id}', 'FrontController@show')->where(['id' => '[0-9]+']);

Route::get('/author/{id}', 'FrontController@showBookByAuthor')->name('author_book')->where(['id'=> '[0-9]+']);

Route::get('/genre/{id}', 'FrontController@showBookByGenre')->where(['id' => '[0-9]+']);

Route::resource('/admin/book', 'BookController')->middleware('auth');

Auth::routes();

/**
 * On peut avoir plusieurs paramètres dans l'url
 */
/*Route::get('/books/{word1}/{word2}', function(string $word1, string $word2){
    $search = $word1 . ' ' . $word2;
    $result = \App\Book::where('title', 'like', "%$search%")->get();

    if(count($result) == 0 ){
        return 'No book found';
    }
    return $result;
})->where(['word1' => '[a-z]+', 'word2' => '[a-z]+']);*/