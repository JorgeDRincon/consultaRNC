<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RncImportController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Grupo de rutas para la documentación
Route::prefix('documentation')->group(function () {
    // Página principal de documentación
    Route::get('/', function () {
        return Inertia::render('Documentation');
    })->name('documentation.index');

    // Página de endpoints y parámetros
    Route::get('/endpoints', function () {
        return Inertia::render('Documentation/Endpoints');
    })->name('documentation.endpoints');

    // Página de tipos de respuestas
    Route::get('/responses', function () {
        return Inertia::render('Documentation/Responses');
    })->name('documentation.responses');

    Route::get('/about', function () {
        return Inertia::render('About');
    })->name('about');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/rnc/import', function () {
    return Inertia::render('RncImport');
})->name('rnc.import');

Route::post('/rnc/import', [RncImportController::class, 'importForm'])->name('rnc.import.form');
