<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\Floor;
use Livewire\Component;
use Illuminate\Http\Request;

class Cas1stFloor extends Component
{
    public $floor;
    public $rooms;
    public $totalComputers;

    public function mount($floorId)
    {
        $this->floor = Floor::findOrFail($floorId);

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

    public function viewRoom105($roomId)
    {
        return redirect()->route('cas105', ['roomId' => $roomId]);
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
        return view('livewire.cas.cas1st-floor', [
            'rooms' => $this->rooms,
            'totalComputers' => $this->totalComputers,
        ]);
    }

    public function goToHigherFloor()
    {
        $nextFloorId = 2;
        return redirect()->route('cas2nd-floor', ['floorId' => $nextFloorId]);
    }

    public function exitBuilding()
    {
        return redirect()->route('building-button');
    }

    public function updatePositions(Request $request)
    {
        $positions = $request->input();

        foreach ($positions as $position) {
            $room = Room::find($position['id']);
            if ($room) {
                $room->top = $position['top'];
                $room->left = $position['left'];
                $room->save();
            }
        }

        return response()->json(['success' => true], 200);
    }

    public function getRoomPositions()
    {
        $rooms = Room::all(['id', 'top', 'left']);
        return response()->json($rooms);
    }

}
