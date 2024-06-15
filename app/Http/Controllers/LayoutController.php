<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function print($roomId)
    {
        $room = Room::findOrFail($roomId);
        return view('layouts.print', compact('room'));
    }
}
