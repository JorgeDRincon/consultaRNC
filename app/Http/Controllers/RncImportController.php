<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\ImportRncCsvJob;

class RncImportController extends Controller
{
  public function importForm(Request $request)
  {
    Log::info('Importando archivo CSV');
    $request->validate([
      'file' => 'required|mimes:csv,txt|max:200000'
    ]);

    try {
      // Guardar el archivo temporalmente
      $path = $request->file('file')->storeAs('imports', uniqid('rnc_') . '.csv', 'local');

      $fullPath = storage_path('app/private/' . $path);
      if (!file_exists($fullPath)) {
        Log::error('El archivo no existe justo antes de despachar el Job', ['path' => $fullPath]);
      } else {
        Log::info('El archivo SÍ existe antes de despachar el Job', ['path' => $fullPath]);
      }

      // Despachar el Job para importar en background
      ImportRncCsvJob::dispatch($path)->delay(now()->addSeconds(2));

      return redirect()->back()->with('success', "El archivo se está importando en segundo plano. Recibirás una notificación cuando termine.");
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error al subir el archivo: ' . $e->getMessage());
    }
  }
}