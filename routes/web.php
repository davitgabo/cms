<?php

use App\Http\Controllers\ViewController;
use App\Http\Middleware\SetLocaleFront;
use Illuminate\Support\Facades\Route;
Route::redirect('/', '/ka');

Route::get('/language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ka'])) {
        abort(400);
    }

    session(['locale' => $locale]);
    return redirect()->back();
})->name('language.switch');

Route::middleware(SetLocaleFront::class)
    ->controller(ViewController::class)
    ->group(function () {
    Route::get('/{locale}', 'index')->name('index');
    Route::get('/{locale}/{slug}', 'index')->name('view');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
