<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/pcms');
});

Route::get('/language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ka'])) {
        abort(400);
    }

    session(['locale' => $locale]);
    return redirect()->back();
})->name('language.switch');
