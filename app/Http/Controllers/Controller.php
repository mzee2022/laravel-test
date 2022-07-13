<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    public function sendJsonSuccessResponse($message, $data = [])
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * @param $message
     * @param string $exceptionMessage
     * @return JsonResponse
     */
    public function sendJsonErrorResponse($message, $exceptionMessage = '' )
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'exception_error' => $exceptionMessage
        ]);
    }
}
