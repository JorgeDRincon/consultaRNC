<?php

namespace App\Http\Controllers;

use App\Models\Rnc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class RncController extends Controller
{
  /**
   * Search RNC records by one or more parameters.
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function advancedSearch(Request $request): JsonResponse
  {
    $allowedParams = Rnc::getAllowedSearchParams();
    $inputParams = array_keys($request->all());
    $invalidParams = array_diff($inputParams, $allowedParams);

    if (count($inputParams) > 0 && count($invalidParams) > 0) {
      return response()->json([
        'message' => 'Invalid parameter(s): ' . implode(', ', $invalidParams),
        'allowed_parameters' => array_values($allowedParams)
      ], 422);
    }

    if ($request->status) {
      $statusValidation = Rnc::validateStatusValue($request->status);
      if (!$statusValidation['valid']) {
        return response()->json($statusValidation['error'], 422);
      }
    }

    $params = $request->only($allowedParams);
    $result = Rnc::filterByParams($params);
    $query = $result['query'];
    $hasFilter = $result['hasFilter'];

    $paginator = $query->paginate(100)->appends(request()->query());

    if ($paginator->total() === 0) {
      return response()->json([
        'message' => 'No records found.',
        'total' => 0,
      ], 404);
    }

    return response()->json([
      'message' => $hasFilter ? 'Search completed.' : 'No filters provided. Showing first page of 100 records.',
      'pages' => $paginator->lastPage(),
      'next' => $paginator->nextPageUrl(),
      'prev' => $paginator->previousPageUrl(),
      'total' => $paginator->total(),
      'data' => $paginator->items(),
    ], 200);
  }
}
