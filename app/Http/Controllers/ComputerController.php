<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;
use Illuminate\Support\Facades\Auth; 
use App\Models\Room;

class ComputerController extends Controller
{
    public function store(Request $request)
    {

        $computer = Computer::create($request->all());

        $room = $computer->room;
        $room->number_of_computers = $room->computers()->count();
        $room->save();

    }

    public function destroy(Computer $computer)
    {
        $room = $computer->room;
        $computer->delete();

        $room->number_of_computers = $room->computers()->count();
        $room->save();

    }
    public function getComputersByRoom($roomId)
    {
        $computers = Computer::where('room_id', $roomId)->get();
        return response()->json($computers);
    }

    public function getComputerDetails($computerId)
    {
        $computer = Computer::find($computerId);
        return response()->json($computer);
    }
    public function updateStatus(Request $request, Computer $computer)
    {
        $request->validate([
            'working' => 'required|boolean',
        ]);

        $computer->update([
            'working' => $request->working,
        ]);
        
        activity()
            ->causedBy(Auth::user())
            ->performedOn($computer)
            ->withProperties(['status' => $request->working])
            ->log('Updated computer status');
            
        return response()->json(['message' => 'Computer status updated successfully']);
    }
    
    public function updatePosition(Request $request, Computer $computer)
    {
        $request->validate([
            'top' => 'required|numeric',
            'left' => 'required|numeric',
        ]);

        $computer->update([
            'top' => $request->input('top'),
            'left' => $request->input('left'),
        ]);
        activity()
            ->causedBy(Auth::user())
            ->performedOn($computer)
            ->withProperties(['remarks' => $request->remarks])
            ->log('Updated computer remarks');

        return response()->json(['message' => 'Computer position updated successfully', 'computer' => $computer]);
    }
    public function updateRemarks(Request $request, $computerId)
    {
        $request->validate([
            'remarks' => 'nullable|string|max:255',
        ]);

        $computer = Computer::findOrFail($computerId);
        $computer->remarks = $request->input('remarks');
        $computer->save();

        return response()->json(['message' => 'Remarks updated successfully', 'data' => $computer]);
    }
}