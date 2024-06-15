<div class="uiverse-container">
    <link href="{{ asset('css/cas1st.css?version=7') }}" rel="stylesheet">

    <div>
        <img style="width: 150%;" src="{{ asset('images/ground.png') }}" alt="Floor Image">

        @foreach($rooms as $room)
            <div class="draggable-wrapper" data-id="{{ $room->id }}">
                <div class="tooltip-container">
                    <button wire:click="viewRoom105({{ $room->id }})" class="uiverse">{{ $room->roomName }}</button>
                    <span class="tooltip">
                        Total Computers: {{ $room->computers->count() }}<br>
                        Working Computers: {{ $room->working_computers_count }}<br>
                        Not Working Computers: {{ $room->not_working_computers_count }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="otherBTN-container">
        <button wire:click="exitBuilding" class="exit-button">
            <span>Exit Building</span>
        </button>
        <button wire:click="goToHigherFloor" class="go-up">
            <span class="shadow"></span>
            <span class="edge"></span>
            <span class="front text">Go up</span>
        </button>
        <button id="savePositionsButton" class="savePositionsBtn">
            <span>Save Room Positions</span>
        </button>
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.sortable.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            // Center new rooms
            const container = $('.uiverse-container');
            const containerWidth = container.width();
            const containerHeight = container.height();

            $('.draggable-wrapper').each(function() {
                const wrapperId = $(this).data('id');
                const storedPosition = localStorage.getItem(`room-${wrapperId}-position`);

                if (!storedPosition) {
                    const centerX = (containerWidth - $(this).outerWidth()) / 2;
                    const centerY = (containerHeight - $(this).outerHeight()) / 2;
                    $(this).css({ top: centerY + 'px', left: centerX + 'px' });
                } else {
                    const position = JSON.parse(storedPosition);
                    $(this).css({ top: position.top, left: position.left });
                }
            });

            // Draggability
            $(".draggable-wrapper").draggable({
                axis: false,
                scroll: false,
                start: function() {
                    $(this).css("z-index", 9999);
                },
                stop: function(event, ui) {
                    $(this).css("z-index", "");
                    const wrapperId = $(this).data('id');
                    const position = { top: ui.position.top, left: ui.position.left };
                    localStorage.setItem(`room-${wrapperId}-position`, JSON.stringify(position));
                }
            });

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

            // Tooltip functionality
            $('.tooltip-container .uiverse').hover(function() {
                $(this).siblings('.tooltip').fadeIn(200);
            }, function() {
                $(this).siblings('.tooltip').fadeOut(200);
            });
        });
    </script>
</div>
