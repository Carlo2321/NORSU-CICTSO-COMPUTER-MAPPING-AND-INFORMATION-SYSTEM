<div class="uiverse-container">
    <link href="{{ asset('css/cas2nd.css?version=8') }}" rel="stylesheet">
    <div>
        <img style="width: 150%;" src="{{ asset('images/sikandplor.png') }}" alt="Floor Image">

        @foreach($rooms as $room)
        <div class="draggable-wrapper" data-id="{{ $room->id }}">
            <div class="tooltip-container">
                <button wire:click="viewRoomCICTSO({{ $room->id }})" class="uiverse">{{ $room->roomName }}</button>
                <span class="tooltip">
                    Total Computers: {{ $room->computers->count() }}<br>
                    Working Computers: {{ $room->working_computers_count }}<br>
                    Not Working Computers: {{ $room->not_working_computers_count }}
                </span>
            </div>
        </div>
        @endforeach
        @php
            $anotherRoom = $rooms->first(function($room) {
                return !$this->checkRoomId($room->id);
            });
        @endphp

        <button wire:click="goToLowerFloor" class="go-down">
            <span class="shadow down-shadow"></span>
            <span class="edge down-edge"></span>
            <span class="front down-front text">Go down</span>
        </button>
        <button wire:click="goToHigherFloor" class="go-up">
            <span class="shadow up-shadow"></span>
            <span class="edge up-edge"></span>
            <span class="front up-front text">Go up</span>
        </button>

        <button wire:click="exitBuilding" class="exit-button">
            <span>Exit Building</span>
        </button>

        <button id="savePositionsButton" class="savePositionsBtn">
            <span>Save Room Positions</span>
        </button>
    </div>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>


    <script>
    $(document).ready(function() {
        // Function to calculate top and left positions for new rooms
        function calculateNewRoomPosition(containerWidth, containerHeight, roomWidth, roomHeight) {
            const centerX = (containerWidth - roomWidth) / 2;
            const topMargin = 50; // Adjust as needed
            const topPosition = topMargin;
            return { top: topPosition + 'px', left: centerX + 'px' };
        }

        // Center existing rooms and set up draggability
        $('.draggable-wrapper').each(function() {
            const wrapperId = $(this).data('id');
            const storedPosition = localStorage.getItem(`room-${wrapperId}-position`);
            const container = $('.uiverse-container');
            const containerWidth = container.width();
            const containerHeight = container.height();
            const roomWidth = $(this).outerWidth();
            const roomHeight = $(this).outerHeight();

            if (!storedPosition) {
                const position = calculateNewRoomPosition(containerWidth, containerHeight, roomWidth, roomHeight);
                $(this).css({ top: position.top, left: position.left });
            } else {
                const position = JSON.parse(storedPosition);
                $(this).css({ top: position.top, left: position.left });
            }

            // Draggability
            $(this).draggable({
                axis: false,
                scroll: false,
                start: function() {
                    $(this).css("z-index", 9999);
                },
                stop: function(event, ui) {
                    $(this).css("z-index", "");
                    const position = { top: ui.position.top, left: ui.position.left };
                    localStorage.setItem(`room-${wrapperId}-position`, JSON.stringify(position));
                }
            });
        });

        // Event listener for save positions button
        $('#savePositionsButton').on('click', function() {
            const positions = [];
            $('.draggable-wrapper').each(function() {
                const wrapperId = $(this).data('id');
                const top = parseFloat($(this).css('top'));
                const left = parseFloat($(this).css('left'));

                positions.push({
                    id: wrapperId,
                    top: top,
                    left: left
                });
            });

            // Send the room positions to the server
            $.ajax({
                url: '/api/rooms/positions',
                method: 'PUT',
                data: JSON.stringify(positions),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    console.log('Positions saved successfully');
                    alert('Positions have been saved successfully!');
                },
                error: function(error) {
                    console.error('Error saving positions:', error);
                    alert('There has been an error');
                }
            });
        });
    });
</script>

</div>
