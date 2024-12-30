<?php

namespace App\Http\Controllers\back\room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{

    public function index()
    {
        $roomTypes = RoomType::all();
        return view('back.roomtype.roomtypelist', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $checkboxFields = [
            'security', 'air_conditioned', 'free_wifi', 'parking', 'restaurant',
            'complimentary_breakfast', 'hair_dryer', 'mini_fridge', 'room_service', 'swimming_pool'
        ];

        foreach ($checkboxFields as $field) {
            if (isset($data[$field]) && $data[$field] === 'on') {
                $data[$field] = true;
            } else {
                $data[$field] = false;
            }
        }
        // dd($data);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'max_occupancy' => 'required|integer|min:1',
        ]);
        RoomType::create($data);

        return response()->json(['message' => 'Room Type added successfully']);
    }

    public function update(Request $request, $id)
    {
        $roomType = RoomType::findOrFail($id);
        $features = [
            'security', 'air_conditioned', 'free_wifi', 'parking', 'restaurant',
            'complimentary_breakfast', 'hair_dryer', 'mini_fridge', 'room_service', 'swimming_pool'
        ];

        foreach ($features as $feature) {
            $request[$feature] = $request->has($feature) ? true : false;
        }
        $roomType->update([
            'name' => $request->name,
            'description' => $request->description,
            'max_occupancy' => $request->max_occupancy,
            'security' => $request->security,
            'air_conditioned' => $request->air_conditioned,
            'free_wifi' => $request->free_wifi,
            'parking' => $request->parking,
            'restaurant' => $request->restaurant,
            'complimentary_breakfast' => $request->complimentary_breakfast,
            'hair_dryer' => $request->hair_dryer,
            'mini_fridge' => $request->mini_fridge,
            'room_service' => $request->room_service,
            'swimming_pool' => $request->swimming_pool,
        ]);

        return response()->json(['message' => 'Room Type updated successfully']);
    }

    public function destroy(Request $request , $id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();

        return response()->json(['message' => 'Room Type deleted successfully']);
    }
}
