<?php

namespace App\Http\Controllers;

use App\Models\Rnc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class RncController extends Controller
{
    /**
     * Retrieve a specific RNC record by its RNC number, with validation.
     *
     * @param string $rnc The RNC number from the route parameter.
     * @return JsonResponse
     */
    public function show(string $rnc): JsonResponse
    {
        try {
            $validator = validator(['rnc' => $rnc], [
                'rnc' => ['required', 'string', 'digits_between:9,11'],
            ]);

            $validator->validate();

            $record = Rnc::where('rnc', $rnc)->first();

            if (!$record) {
                return response()->json([
                    'message' => 'RNC record not found for the provided RNC number.',
                ], 404);
            }

            return response()->json([
                'message' => 'RNC record retrieved successfully.',
                'data' => $record,
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The provided RNC is invalid.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}