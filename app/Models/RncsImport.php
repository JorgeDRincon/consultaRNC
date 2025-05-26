<?php

namespace App\Models;

use App\Models\Rnc;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class RncsImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
  public function model(array $row)
  {
    return new Rnc([
      'rnc' => $row['rnc'] ?? $row['RNC'] ?? null,
      'business_name' => $row['razón social'] ?? $row['RAZÓN SOCIAL'] ?? null,
      'economic_activity' => $row['actividad económica'] ?? $row['ACTIVIDAD ECONÓMICA'] ?? null,
      'start_date' => $row['fecha de inicio operaciones'] ?? $row['FECHA DE INICIO OPERACIONES'] ?? null,
      'status' => $row['estado'] ?? $row['ESTADO'] ?? null,
      'payment_regime' => $row['régimen de pago'] ?? $row['RÉGIMEN DE PAGO'] ?? null,
    ]);
  }

  public function getCsvSettings(): array
  {
    return [
      'delimiter' => ',',
      'enclosure' => '"',
      'line_ending' => "\n",
      'use_bom' => false,
      'input_encoding' => 'UTF-8',
    ];
  }
}