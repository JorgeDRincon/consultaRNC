<?php

use App\Http\Controllers\RncController;
use App\Http\Controllers\RncImportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::get('/rnc/{rnc}', [RncController::class, 'show']);
Route::post('/rncs/import', [RncImportController::class, 'import']);

Route::get('/rnc-import/progress', function () {
  $progressFile = storage_path('app/import_progress.json');
  if (file_exists($progressFile)) {
    $data = json_decode(file_get_contents($progressFile), true);
    return response()->json($data);
  }
  return response()->json(['processed' => 0, 'total' => 0]);
});