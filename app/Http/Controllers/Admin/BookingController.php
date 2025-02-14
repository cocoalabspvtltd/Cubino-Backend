<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\HotelRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = Booking::with('room.hotel')->get();

       return view('booking.index',compact('data'));
    }

    public function checkIn(Request $request, $booking)
    {
        // Find the booking by its ID
        $booking = Booking::findOrFail($booking);

        // Ensure the booking is confirmed and not already checked-in
        if ($booking->status === 'confirmed' && !$booking->is_checked_in) {
            $booking->is_checked_in = true;
            $booking->checked_in_at = Carbon::now();
            $booking->save();

            return response()->json(['success' => true, 'message' => 'Successfully checked in.','checked_in_at' => $booking->checked_in_at]);
        }

        return response()->json(['success' => false, 'message' => 'Unable to check in at this time.'], 400);
    }

    public function checkOut(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->is_checked_in && !$booking->is_checked_out) {
            $booking->is_checked_out = true;
            $booking->checked_out_at = Carbon::now();
            $booking->save();

            if ($booking->room_id) {
                $room = HotelRooms::find($booking->room_id);
                $hotel = Hotel::find($room->hotel_id);
                        if ($hotel) {
                            $hotel->booked_count = max(0, $hotel->booked_count - $booking->room_count);
                            $hotel->save();
                        }
            }
            return response()->json(['success' => true, 'message' => 'Successfully checked out.','checked_out_at' => $booking->checked_out_at]);
        }



        return response()->json(['success' => false, 'message' => 'Unable to check out at this time.'], 400);
    }





}
