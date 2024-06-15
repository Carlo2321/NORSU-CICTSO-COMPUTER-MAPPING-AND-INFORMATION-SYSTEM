<div>
    @if(empty($data))
    <div class="text-gray-500">No room data available.</div>
    @else
        <div class="flex items-center justify-between">
            <p class="text-xl font-bold">Room with Most Not Working Computers:</p>
            <div class="text-right">
                <p>{{ $data['not_working_count'] }} Not Working</p>
            </div>
        </div>
        <ul class="pl-4 mt-2 list-disc">
            <li>Room Name: {{ $data['room_name'] }}</li>
            <li>Floor Number: {{ $data['floor_number'] }}</li>
        </ul>
    @endif
</div>
