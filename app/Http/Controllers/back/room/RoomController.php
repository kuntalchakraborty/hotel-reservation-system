<?php

namespace App\Http\Controllers\back\room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\RoomImage;


class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::with('roomType')->get();
        return view('back.rooms.roomindex', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('back.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required',
            'room_number' => 'required',
            'price' => 'required',
            'bed_count' => 'required',
            'bed_type' => 'required',
            'floor_number' => 'required',
            'room_status' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $room = Room::create($request->except('images'));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('rooms', 'public');
                // Create a room image record
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('rooms.index')->with('success', 'Room added successfully.');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $roomTypes = RoomType::all();
        return view('back.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $request->validate([
            'room_type_id' => 'required',
            'room_number' => 'required',
            'price' => 'required',
            'bed_count' => 'required',
            'bed_type' => 'required',
            'floor_number' => 'required',
            'room_status' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $room->update($request->except('images'));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('rooms', 'public');
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        foreach ($room->images as $image) {
            $imagePath = storage_path('app/public/' . $image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room and its images deleted successfully!');
    }

    public function imagedestroy($id)
    {
        try {
            $image = RoomImage::findOrFail($id);
            $imagePath = storage_path('app/public/' . $image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Image deletion failed.'], 500);
        }
    }
}
