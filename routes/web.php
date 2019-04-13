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
Route::get('/home',function(){
    
    $tasks = DB::table('tasks')->get();
    return view('home', compact('tasks'));
}) ;
// Route::get('/home', function () {
// $tasks = DB::table('tasks')->where('name', 'like', '%'.$search.'%')->paginate(5);
//         return view('home',['tasks'=>$tasks]);
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get("/{id}/complete", "TaskController@complete");
Route::resource('tasks','TaskController');
Route::get('/home', 'TaskController@search');
Route::get('/search', 'TaskController@search');


  