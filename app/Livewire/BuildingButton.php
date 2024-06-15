<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\Floor;
use Livewire\Component;
use App\Models\Building;
use Illuminate\Support\Facades\Redirect;

class BuildingButton extends Component
{
    public $showFloors = false;
    public $building;
    public $floors;

    public function toggleFloors()
    {
        $this->showFloors = !$this->showFloors;
    }

    public function mount()
    {
        $this->building = Building::first();
        $this->floorMount();
    }

    public function floorMount()
    {
        $this->floors = Floor::where('building_id', $this->building->id)->get(); // Fetch floors for the current building
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

    public function render()
    {
        return view('livewire.building-button');
    }

    // Get room with the most not working computers
    public function redirectToRoomWithMostNotWorking()
    {
        $roomWithMostNotWorking = Room::with(['computers' => function($query) {
            $query->where('working', false);
        }])
        ->get()
        ->sortByDesc(fn($room) => $room->computers->where('working', false)->count())
        ->first();

        if ($roomWithMostNotWorking) {
            $route = ($roomWithMostNotWorking->id === 105) ? 'cas105' : 'cas106';

            return Redirect::route($route, ['roomId' => $roomWithMostNotWorking->id]);
        }

        return Redirect::routes('building-button');
    }

}
