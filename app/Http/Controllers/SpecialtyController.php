<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use Illuminate\Http\JsonResponse;

class SpecialtyController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $specialties = Specialty::all();
        return response()->json($specialties);
    }
}
