<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RncImportController;

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/rnc/import', function () {
  return view('rnc_import');
})->name('rnc.import.form');

Route::post('/rnc/import', [RncImportController::class, 'importForm'])->name('rnc.import.form');
