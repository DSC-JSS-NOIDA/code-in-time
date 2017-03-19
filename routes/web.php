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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/rules', 'HomeController@rules')->name('rules');
Route::get('/question/{id}', 'HomeController@question');
Route::post('/submission', 'HomeController@submission');
Route::get('/leaderboard', 'HomeController@leaderboard')->name('leaderboard');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('admin', 'AdminController@index');
    Route::post('addques', 'AdminController@addques');
    Route::get('edit/{id}', 'AdminController@editor');
    Route::get('delete/{id}', 'AdminController@delete');
    Route::get('download/{filename}', function($filename)
	{
	    // Check if file exists in app/storage/file folder
	    $file_path = storage_path() .'/testcases/'. $filename;
	    if (file_exists($file_path))
	    {
	        // Send Download
	        return Response::download($file_path, $filename, [
	            'Content-Length: '. filesize($file_path)
	        ]);
	    }
	    else
	    {
	        // Error
	        exit('Requested file does not exist on our server!');
	    }
	})
	->where('filename', '[A-Za-z0-9\-\_\.]+');
});
