<div>
    <link href="{{ asset('css/cas102.css') }}" rel="stylesheet">

    <div class="legend">
        <p>
            <span class="legend-color working"></span> Working Computers
        </p>
        <p>
            <span class="legend-color not-working"></span> Not Working Computers
        </p>
    </div>
    <div class="current-room" style="display: flex; align-items: center; justify-content:center; font-family:'Courier New', Courier, monospace;">
        <p>
            <h3>
                Current Room: {{ $roomName }}
            </h3>
        </p>
    </div>

    <div class="uiverse-container">
        @foreach($computers as $computer)
            <div class="draggable-wrapper" data-id="{{ $computer->id }}" style="top: {{ $computer->top }}px; left: {{ $computer->left }}px;">
                <button class="uiverse {{ $computer->working ? 'working' : 'not-working' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full fill-current" viewBox="0 0 576 512">
                        <path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64H240l-10.7 32H160c-17.7 0-32 14.3-32 32s14.3 32 32 32H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H346.7L336 416H512c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM512 64V352H64V64H512z"/>
                    </svg>
                    <div class="tooltip">
                        Hostname: {{ $computer->computerName }}<br>
                        IP Address: {{ $computer->ipAddress }}<br>
                        MAC Address: {{ $computer->macAddress }}<br>
                        Status: {{ $computer->working ? 'Working' : 'Not working' }}
                    </div>
                </button>
            </div>
        @endforeach
    </div>

    <button id="addComputerButton" class="addComputerBtn">
        <span>Add Computer</span>
    </button>

    <button id="savePositionsButton" class="savePositionsBtn">
        <span>Save Positions</span>
    </button>

    <div class="navigation-buttons">
        <button wire:click="backToFloor" class="back-button">
            <span>Back to floor</span>
        </button>
        <button wire:click="exitBuilding" class="exit-button">
            <span>Exit Building</span>
        </button>
    </div>

    <div class="computer-counts">
        <p>
            <u>
            Computers: {{ $totalComputers }}
            </u>
        </p>
        <p>
            <u>
            Working: {{ $workingComputers }}
            </u>
        </p>
        <p>
            <u>
            Not working: {{ $notWorkingComputers }}
            </u>
        </p>
    </div>
</div>

<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>

<script>
    $(document).ready(function() {
        function getCenterCoordinates() {
            const windowWidth = $(window).width();
            const windowHeight = $(window).height();
            const computerWidth = 50;
            const computerHeight = 50;

            const centerX = (windowWidth - computerWidth) / 2;
            const centerY = (windowHeight - computerHeight) / 2;

            return { top: centerY, left: centerX };
        }

        // Event listener for adding a new computer
        $('#addComputerButton').on('click', function() {
            const centerCoordinates = getCenterCoordinates();

            $.ajax({
                url: '/api/computers',
                method: 'POST',
                data: JSON.stringify({ top: centerCoordinates.top, left: centerCoordinates.left }),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    console.log('New computer added successfully');
                    alert('New computer has been added successfully!');
                },
                error: function(error) {
                    console.error('Error adding new computer:', error);
                    alert('There has been an error');
                }
            });
        });
    });
</script>
