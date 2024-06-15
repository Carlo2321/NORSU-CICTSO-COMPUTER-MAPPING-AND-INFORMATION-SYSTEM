<div>
    <link href="{{ asset('css/styles.css?version=42') }}" rel="stylesheet">
    <div class="logo-container">
        <img class="norsulogo" src="images/logo.ico" alt="logo">
        <div class="button-group">
            <button wire:click="toggleFloors" class="livewire-button">{{ $building->buildingName }}</button>
            <button wire:click="redirectToRoomWithMostNotWorking" class="exclamation-button">!</button>
        </div>
    </div>
    <div class="container">
        @if($showFloors)
            <div class="floor-buttons">
                @foreach($floors as $floor)
                    <button wire:click="selectFloor({{ $floor->id }})" class="floor-button">{{ $floor->floorNumber }}</button>
                @endforeach
            </div>
        @endif
    </div>
</div>
