<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserHistory;
use App\Models\Regional;
use Illuminate\Support\Facades\Validator;

class UserHistoryController extends Controller
{
    public function index()
    {
        $userHistory = UserHistory::with('regional')->get();

        return response()->json($userHistory);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'regional_id' => 'required|exists:regionals,id',
            'corporate_name' => 'required|string|max:255',
            'trade_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14',
            'start_date' => 'required|date',
            'status' => 'required|boolean',
            'specialties' => 'nullable|array',
            'specialties.*' => 'exists:specialties,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $userHistory = UserHistory::create($request->except('specialties'));

        if (!empty($request->specialties)) {
            $userHistory->specialties()->sync($request->specialties);
        }

        return response()->json($userHistory->load('specialties'), 201);
    }

    public function show(int $id)
    {
        $userHistory = UserHistory::with('regional')->find(request()->id);
        return response()->json($userHistory);
    }

    public function update(Request $request)
    {
        $userHistory = UserHistory::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'.$userHistory->id,
            'regional_id' => 'required|exists:regionals,id',
            'corporate_name' => 'required|string|max:255',
            'trade_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14',
            'start_date' => 'required|date',
            'status' => 'required|boolean',
            'specialties' => 'nullable|array',
            'specialties.*' => 'exists:specialties,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $userHistory->update($request->except('specialties'));

        if (!empty($request->specialties)) {
            $userHistory->specialties()->sync($request->specialties);
        }

        return response()->json($userHistory->load('specialties'), 200);
    }

    public function destroy(int $id)
    {
        $userHistory = UserHistory::findOrFail($id);
        $userHistory->delete();

        return response()->json(null, 204);
    }
}
