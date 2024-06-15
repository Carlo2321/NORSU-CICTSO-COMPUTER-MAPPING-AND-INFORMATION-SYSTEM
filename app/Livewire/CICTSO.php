<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;
use App\Models\Computer;
use Illuminate\Http\Request;

class CICTSO extends Component
{
    public $room;
    public $computers;
    public $selectedComputer = null;
    public $totalComputers;
    public $workingComputers;
    public $notWorkingComputers;
    public $roomName;

    public function mount($roomId)
    {
        $this->room = Room::findOrFail($roomId);
        $this->computers = Computer::where('room_id', $roomId)->get();
        $this->totalComputers = count($this->computers);
        $this->workingComputers = $this->computers->where('working', true)->count();
        $this->notWorkingComputers = $this->computers->where('working', false)->count();
        $this->roomName = $this->room->roomName;
    }

    public function showComputerDetails($computerId)
    {
        // Toggle the selected computer
        if ($this->selectedComputer === $computerId) {
            $this->selectedComputer = null;
        } else {
            $this->selectedComputer = $computerId;
        }
    }

    public function backToFloor()
    {
        return redirect()->route('cas2nd-floor', ['floorId' => $this->room->floor_id]);
    }


    public function exitBuilding()
    {
        return redirect()->route('building-button');
    }

    public function render()
    {
        return view('livewire.cas.c-i-c-t-s-o', [
            'roomName' => $this->roomName,
        ]);
    }

    public function updatePositions(Request $request)
    {
    // Get the positions data from the request body
    $positions = $request->input();

    // Iterate through each position object in the array
    foreach ($positions as $position) {
        // Find the computer by ID
        $computer = Computer::find($position['id']);

        if ($computer) {
            // Update the top and left properties
            $computer->top = $position['top'];
            $computer->left = $position['left'];
            $computer->save();
        }
    }

    // Return a JSON response indicating success
    return response()->json(['success' => true], 200);
    }
}
