<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Hotel;
use App\Models\HotelRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = HotelRooms::all();

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
        return view('rooms.create', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->all();
        //dd($validatedData);

        // Handle multiple image uploads
        $images = [];
        if ($request->hasFile('room_images')) {
            foreach ($request->file('room_images') as $image) {
                $images[] = $image->store('room_images', 'public'); // Store in 'storage/app/public/room_images'
            }
        }

        $validatedData['room_images'] = json_encode($images);

        $rooms = HotelRooms::create($validatedData);

        return redirect()->route('rooms.index')->with('Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HotelRooms $room)
    {
        $hotels = Hotel::all(); // Fetch all hotels
        $selectedHotelId = $room->hotel_id;

        return view('rooms.edit', compact('room', 'hotels','selectedHotelId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HotelRooms $room)
    {
        $validatedData = $request->all();

        $existingImages = is_array($room->room_images) ? $room->room_images : (json_decode($room->room_images, true) ?? []);
        $images = $existingImages;

        if (is_array($room->room_images)) {
            $images = $room->room_images;
        } else {
            $images = json_decode($room->room_images, true) ?? []; 
        }

        // Handle image removal
        if ($request->has('remove_images')) {
            $imagesToRemove = $request->input('remove_images');

            // Remove images from the array and delete them from storage
            $images = array_filter($images, function ($image) use ($imagesToRemove) {
                if (in_array($image, $imagesToRemove)) {
                    Storage::disk('public')->delete($image); // Delete the image from storage
                    return false; // Exclude this image from the array
                }
                return true;
            });
        }

        // Update the room_images field
        $validatedData['room_images'] = json_encode(array_values($images));

        $room->update($validatedData);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
