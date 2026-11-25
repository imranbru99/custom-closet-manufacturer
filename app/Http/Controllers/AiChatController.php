<?php

namespace App\Http\Controllers;

use App\Services\AiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AiChatController extends Controller
{
    public function __invoke(Request $request, AiService $ai): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        return response()->json([
            'reply' => $ai->chat($data['message'], 'public'),
        ]);
    }
}
