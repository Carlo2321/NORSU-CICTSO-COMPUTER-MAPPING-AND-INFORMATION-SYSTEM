<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
   public function index()
    {
        $floors = Floor::all();
        return response()->json($floors);
    }

    public function show($id)
    {
        $floor = Floor::findOrFail($id);
        return response()->json($floor);
    }
}
