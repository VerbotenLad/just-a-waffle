<?php

use App\Models\Post;
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

    return view('posts', [
        'posts' => Post::all()
    ]);
});


//This get method returns a view function which can take either a KEY or a KEY VALUE pair
Route::get('posts/{post}', function($slug) {
    //Find a post by its slug, pass it to a view named "post"
    return view('post', [
        'post' => Post::find($slug)
    ]);


})->where('post', '[A-z_\-]+'); //this says that the VALUE of the KEY 'post' should match the specified regex


Route::get('/{any}', 'App\Http\Controllers\PagesController@index')->where('any', '.*');
