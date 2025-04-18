<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserHistory;
use App\Models\UserHistorySpecialty;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    public function index(Request $request)
    {
        $userHistory = UserHistory::query();

        if ($request->has('search')) {
            $userHistory->where('corporate_name', 'like', "%".$request->search."%")
                ->orWhere('trade_name', 'like', "%".$request->search."%");
        }

        $userHistory = $userHistory->with(['regional', 'specialties']);

        return response()->json($userHistory->paginate(10));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
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

        $request->merge([
            'user_id' => $user->id
        ]);

        $userHistory = UserHistory::create($request->except('specialties'));

        if (!empty($request->specialties)) {
            foreach ($request->specialties as $specialty) {
                UserHistorySpecialty::create([
                    'user_id' => $request->user_id,
                    'user_history_id' => $userHistory->id,
                    'specialty_id' => $specialty
                ]);
            }
        }

        return response()->json($userHistory->load('specialties'), 201);
    }

    public function show(int $id)
    {
        $userHistory = UserHistory::with('regional')->with('specialties')->findOrFail(request()->id);
        return response()->json($userHistory);
    }

    public function update(int $id, Request $request )
    {
        $userHistory = UserHistory::findOrFail($id);

        $validator = Validator::make($request->all(), [
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
            $specialties = [];
            
            foreach ($request->specialties as $specialtyId) {
                $specialties[$specialtyId] = [
                    'user_id' => $userHistory->user_id,
                    'uuid' => (string) Str::uuid()
                ];
            }
    
            $userHistory->specialties()->sync($specialties);
        } else {
            $userHistory->specialties()->detach();
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
