<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test-email', function () {
    Mail::raw('Test email from Serveur 1!', function ($message) {
        $message->to('test@example.com')
                ->subject('Test Email from Serveur 2');
    });

    return 'Email envoyé ! Vérifiez Mailhog sur http://localhost:8025';
});

Route::get('/test-upload', function () {
    Storage::disk('s3')->put('test.txt', 'Hello from Laravel!');
    return 'Fichier uploadé ! Vérifiez Minio Console sur http://localhost:9001';
});

require __DIR__.'/auth.php';
