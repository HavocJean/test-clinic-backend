<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Patient::query()->paginate(10));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'genre' => 'required|string|max:255',
            'trade_name' => 'required|string|max:255',
            'rg' => 'required|string|max:9',
            'cpf' => 'required|string|max:11',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'obs' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $patient = Patient::create($request->all());

        return response()->json($patient, 201);
    }

    function show(int $id): JsonResponse
    {
        $patient = Patient::findOrFail($id);

        return response()->json($patient);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'genre' => 'required|string|max:255',
            'trade_name' => 'required|string|max:255',
            'rg' => 'required|string|max:9',
            'cpf' => 'required|string|max:11',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'obs' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $patient = Patient::findOrFail($id);
        $patient->update($request->all());

        return response()->json($patient);
    }

    public function destroy(int $id): JsonResponse    
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(null, 204);
    }
}
