<?php

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
    $post = App\Models\Post::find(1);

    $data = [
        'website' => $post->website->name,
        'title' => $post->title,
        'description' => $post->description,
    ];

    return new App\Mail\PostMail($data);
});
