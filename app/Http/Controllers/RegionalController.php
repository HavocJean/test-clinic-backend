<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regional;
use Illuminate\Http\JsonResponse;

class RegionalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $regionals = Regional::all();
        return response()->json($regionals);
    }
}
