<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function () {
    return '<h1>Available Jobs</h1>';
})->name('jobs');

Route::get('/test', function () {
    return response('<h1>Hello World</h1>', 200)->header('Content-Type', 'text/html');
});

Route::get('/notfound', function () {
    return response('Page Not Found', 404);
});

Route::get('/download', function () {
    return response()->download(public_path('favicon.ico'));
});
