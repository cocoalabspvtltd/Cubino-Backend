<?php

namespace App\Repositories;

use App\Interfaces\ApiRepositoryInterface;
use App\Models\Booking;
use App\Models\BusinessProperty;
use App\Models\BussinessContact;
use App\Models\Hotel;
use App\Models\HotelRooms;
use App\Models\PopularCity;
use App\Models\RefferalReward;
use App\Models\State;
use App\Models\TravelAgent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class ApiRepository implements ApiRepositoryInterface
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'referral_code' => strtoupper(Str::random(10)),
        ]);

        // Generate Token for the user
        $token = $user->createToken('authToken')->plainTextToken;

        // Return response
        return response()->json([
            'status_code' => 201,
            'success' => true,
            'user_details' => $user,
            'token' => $token,
            'message' => 'User registered successfully.',
        ], 201);
    }

    public function states()
    {
        $data = State::all();

        return response()->json([
            'status_code' => 200,
            'success' => true,
            'states' => $data,
            'message' => 'Staes listed successfully.',
        ], 200);
    }

    public function popular_cities()
    {
        $data = PopularCity::all();

        return response()->json([
            'status_code' => 200,
            'success' => true,
            'states' => $data,
            'message' => 'Cities listed successfully.',
        ], 200);
    }


    public function getrecommendedHotels()
    {
        $guestLimit = 1;
        $roomCount = 1;

        $roomsQuery = HotelRooms::query()
            ->where('guest_limit', '>=', $guestLimit)
            ->whereHas('hotel', function ($query) {
                $query->whereRaw('avaialable_room_count != booked_count');
            });

        $rooms = $roomsQuery->get();

        $rooms = $roomsQuery->with([
            'hotel:id,name,image,policies,address,city,avaialable_room_count,rating'
        ])
            ->get()
            ->map(function ($room) {
                return [
                    'room_id' => $room->id,
                    'description' => $room->description,
                    'amenities' => $room->aminities,
                    'price' => $room->price,
                    'room_images' => $room->room_images,
                    'hotel_name' => $room->hotel->name,
                    'hotel_image' => $room->hotel->image,
                    'hotel_policies' => $room->hotel->policies,
                    'hotel_address' => $room->hotel->address,
                    'hotel_rating' => $room->hotel->rating,

                ];
            });

        return response()->json([
            'status_code' => 200,
            'success' => true,
            'rooms' => $rooms,
            'message' => 'Hpotels listed successfully.',
        ], 200);
    }

    public function getPlacesByCity($cityId)
    {
        return Hotel::where('city', $cityId)
            ->distinct()
            ->pluck('place');
    }

    public function room_booking(array $data)
    {
        $user_id = Auth::id();

        $agent = TravelAgent::where('user_id', $user_id)->first();
        $data['agent_id'] = $agent ? $agent->id : null;

        $data['user_id'] = $user_id;
        $data['start_date'] = Carbon::createFromFormat('d-m-Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d-m-Y', $data['end_date'])->format('Y-m-d');

        $room = HotelRooms::find($data['room_id']);
        if ($room && $room->status == 1) {
            return response()->json([
                'status_code' => 400,
                'success' => false,
                'message' => 'The room is already booked.',
            ], 400);
        }


        $hotel = Hotel::whereId($room->hotel_id)->first();

        if ($hotel->avaialable_room_count == $hotel->booked_count) {
            return response()->json([
                'status_code' => 400,
                'success' => false,
                'message' => 'No available room here.',
            ], 400);
        }

        $data = Booking::create($data);

        if ($data) {
            $hotel->booked_count += $data['room_count'];
            $hotel->update();
        }

        return response()->json([
            'status_code' => 201,
            'success' => true,
            'message' => 'Room Booked successfully.',
        ], 201);
    }

    public function getbooked_rooms()
    {
        $user_id = Auth::id();

        $agent = TravelAgent::where('user_id', $user_id)->first();

        if ($agent) {
            $bookings = Booking::with(['room:id,hotel_id,aminities,price,room_images', 'room.hotel:id,name,address'])->where('agent_id', $agent->id)->where('status', 'confirmed')->get();
        } else {

            $bookings = Booking::with(['room:id,hotel_id,aminities,price,room_images', 'room.hotel:id,name,address'])->where('user_id', $user_id)->where('status', 'confirmed')->get();
        }
        if ($bookings->isEmpty()) {

            return response()->json(['status_code' => 404, 'success' => false, 'message' => 'No booked rooms found.'], 404);
        }

        return response()->json(['status_code' => 200, 'success' => true, 'booked_rooms' => $bookings, 'message' => 'Rooms Listed Successfully'], 200);
    }

    public function cancelBooking($bookingId)
    {
        $user_id = Auth::id();

        $booking = Booking::where('id', $bookingId)->where('user_id', $user_id)->first();

        if ($booking->status === 'cancelled') {
            return response()->json(['status_code' => 400, 'success' => true, 'message' => 'Booking is already cancelled'], 400);
        }

        $booking->status = 'cancelled';
        $booking->save();

        return response()->json(['status_code' => 200, 'success' => true, 'message' => 'Booking canceled successfully', 'booking' => $booking], 200);
    }

    public function getcancelledRooms()
    {
        $user_id = Auth::id();

        $cancelled = Booking::with(['room:id,hotel_id,aminities,price,room_images', 'room.hotel:id,name,address'])->where('user_id', $user_id)->where('status', 'cancelled')->get();

        if ($cancelled->isEmpty()) {
            return response()->json(['status_code' => 404, 'success' => false, 'message' => 'No data found.'], 404);
        }

        return response()->json(['status_code' => 200, 'success' => true, 'cancelled_rooms' => $cancelled, 'message' => 'Data Listed Successfully'], 200);
    }

    public function registerBussinessContact(array $data)
    {
        $data = BussinessContact::create($data);

        if ($data) {
            $to = "lekshmiar06@gmail.com"; // you want to replace the mail id
            $subject = "Greetings from CUBINO!";

            $message = "
                    <html>
                    <head>
                    <title>Greetings</title>
                    </head>
                    <body>
                    <h1>Hello!</h1>
                    <p>We hope this email finds you well. Have a great day!</p>
                    </body>
                    </html>
                    ";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= "From:" . $data->name . " " . $data->email . "\r\n";

            if (mail($to, $subject, $message, $headers)) {
                echo "Email sent successfully to $to!";
            } else {
                echo "Failed to send email.";
            }
        }
    }

    public function storeBusinessProperty(array $data)
    {
        $images = [];
        if (isset($data['property_images']) && is_array($data['property_images'])) {
            foreach ($data['property_images'] as $image) {
                $images[] = $image->store('property_images', 'public');
            }
        }

        $data['property_images'] = json_encode($images);

        $data = BusinessProperty::create($data);

        return response()->json([
            'status_code' => 201,
            'success' => true,
            'data' => $data,
            'message' => 'Property Registred successfully.',
        ], 201);
    }

    public function businessPropertyEnquiry(array $data) {}

    public function registerAgent(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('agent');

        $agentData = [
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'pan_no' => $data['pan_no'],
            'agency_name' => $data['agency_name'],
            'user_id' => $user->id
        ];

        TravelAgent::create($agentData);

        return response()->json([
            'status_code' => 201,
            'success' => true,
            'data' => $data,
            'message' => 'Registered successfully',
        ], 201);
    }

    public function loginAgent(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        /** @var \App\Models\User $user */
        if (!$user->hasRole('agent')) {
            Auth::logout();
            return response()->json(['message' => 'Unauthorized access'], 401);
        }

        // Generate token
        $token = $user->createToken('AgentAuthToken')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function registerWithReferral(array $data)
    {
        $referrer = User::where('referral_code', $data['referral_code'] ?? null)->first();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'referral_code' => strtoupper(Str::random(10)),
            'referred_by' => $referrer ? $referrer->id : null,
        ]);

        if ($referrer) {
            RefferalReward::create([
                'user_id' => $user->id,
                'referrer_id' => $referrer->id,
                'reward_type' => 'points',
                'reward_amount' => 400,
            ]);

            RefferalReward::create([
                'user_id' => $referrer->id,
                'reward_type' => 'points',
                'reward_amount' => 400,
            ]);
        }

        return response()->json(['message' => 'User registered successfully', 'data' => $user], 201);
    }

    public function getReferralDetails($user_id)
    {
        $user = User::with(['referredBy', 'referrals'])->findOrFail($user_id);

        $rewards = RefferalReward::where('user_id', $user_id)
            ->orWhere('referrer_id', $user_id)
            ->get();

        return response()->json([
            'user' => $user,
            'referrals' => $user->referrals,
            'rewards' => $rewards,
        ]);
    }
}

