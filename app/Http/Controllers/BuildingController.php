<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return response()->json($buildings);
    }

    public function show($id)
    {
        $building = Building::findOrFail($id);
        return response()->json($building);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buildingName' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $building = Building::create($request->all());
        return response()->json($building, 201);
    }

    public function update(Request $request, $id)
    {
        $building = Building::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'buildingName' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $building->update($request->all());
        return response()->json($building, 200);
    }

    public function destroy($id)
    {
        $building = Building::findOrFail($id);
        $building->delete();
        return response()->json(null, 204);
    }
    
    public function getFloors($buildingId)
    {
        $floors = Floor::where('building_id', $buildingId)->get();
        return response()->json($floors);
    }


    public function selectFloor($floorId)
    {
        switch ($floorId) {
            case 1:
                return Redirect::route('cas1st-floor', ['floorId' => $floorId]);
            case 2:
                return Redirect::route('cas2nd-floor', ['floorId' => $floorId]);
            case 3:
                return Redirect::route('cas3rd-floor', ['floorId' => $floorId]);
            case 4:
                return Redirect::route('cas4th-floor', ['floorId' => $floorId]);
            default:
                break;
        }
    }
}
