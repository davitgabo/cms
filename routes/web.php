<?php

use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::controller(ViewController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{slug}', 'index')->name('view');
});

Route::get('/language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ka'])) {
        abort(400);
    }

    session(['locale' => $locale]);
    return redirect()->back();
})->name('language.switch');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
