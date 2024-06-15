<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function getRoomWithMostNotWorkingComputers()
    {
        $room = Room::withCount(['computers' => function($query) {
            $query->where('working', false);
        }])->orderBy('computers_count', 'desc')->first();

        return response()->json(['room' => $room]);
    }
    public function getRoomsByFloor($floorId)
    {
        $rooms = Room::where('floor_id', $floorId)->get();
        return response()->json($rooms);
    }

    public function getRoomDetails($roomId)
    {
        $room = Room::find($roomId);
        return response()->json($room);
    }
    public function printLayout($roomId)
    {
        $room = Room::findOrFail($roomId);
        return view('layouts.print', compact('room'));
    }
}
