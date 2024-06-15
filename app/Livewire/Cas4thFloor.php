<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\Floor;
use Livewire\Component;
use Illuminate\Http\Request;

class Cas4thFloor extends Component
{
    public $floor;
    public $rooms;
    public $usedRoomIds = [];
    public $totalComputers;

    public function mount($floorId)
    {
        $this->floor = Floor::findOrFail($floorId);

        // Load rooms with their associated computers and count them
        $this->rooms = Room::where('floor_id', $floorId)->with('computers')->withCount([
            'computers as working_computers_count' => function ($query) {
                $query->where('working', true);
            },
            'computers as not_working_computers_count' => function ($query) {
                $query->where('working', false);
            },
        ])->get();

        // Count total computers
        $this->totalComputers = $this->rooms->flatMap->computers->count();
    }

    public function viewRoom($roomId)
    {
        return redirect()->route('cas106', ['roomId' => $roomId]);
    }

    public function viewRoomSkylab($roomId)
    {
        return redirect()->route('skylab', ['roomId' => $roomId]);
    }
    public function navigateToCas104($roomId)
    {
        return redirect()->route('cas104', ['roomId' => $roomId]);
    }
    public function viewRoom103($roomId)
    {
        return redirect()->route('cas103', ['roomId' => $roomId]);
    }
    public function viewRoom102($roomId)
    {
        return redirect()->route('cas102', ['roomId' => $roomId]);
    }

    public function render()
    {
        return view('livewire.cas.cas4th-floor');
    }

    public function checkRoomId($roomId)
    {
        return in_array($roomId, $this->usedRoomIds);
    }

    public function markRoomAsUsed($roomId)
    {
        $this->usedRoomIds[] = $roomId;
    }
    public function goToLowerFloor()
    {
        // Assuming the next floor ID is known, you can hardcode it here
        $nextFloorId = 3; // Change this to the appropriate floor ID

        // Redirect to the route for the next floor with the floorId parameter
        return redirect()->route('cas3rd-floor', ['floorId' => $nextFloorId]);
    }

    public function exitBuilding()
    {
        return redirect()->route('building-button');
    }
    public function updatePositions(Request $request)
{
    // Get the positions data from the request body
    $positions = $request->input();

    // Iterate through each position object in the array
    foreach ($positions as $position) {
        // Find the room by ID
        $room = Room::find($position['id']);

        if ($room) {
            // Update the top and left properties
            $room->top = $position['top'];
            $room->left = $position['left'];
            $room->save();
        }
    }

    // Return a JSON response indicating success
    return response()->json(['success' => true], 200);
}


}
