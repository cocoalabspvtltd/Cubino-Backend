<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRegisterForm;
use App\Http\Requests\BusinessPropertyRequest;
use App\Http\Requests\BussinessRegisterFormRequest;
use App\Http\Requests\RefferelRegisterFormRequest;
use App\Http\Requests\Request\RegisterFormRequest;
use App\Http\Requests\RoomBookingRequest;
use App\Interfaces\ApiRepositoryInterface;
use App\Interfaces\SMSRepositoryInterface;
use App\Models\Hotel;
use App\Models\HotelRooms;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    protected $apiRepository;
    protected $smsRepository;

    public function __construct(ApiRepositoryInterface $apiRepository, SMSRepositoryInterface $smsRepository)
    {
        $this->apiRepository = $apiRepository;
        $this->smsRepository = $smsRepository;
    }

    public function register(RegisterFormRequest $request)
    {
        $validate = $request->validated();

        return $this->apiRepository->register($request->all());
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Phone number is not registered.'
            ], 404);
        }

        return $this->smsRepository->sendOtp($request->phone_number);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'otp' => 'required|numeric|min:4',
        ]);

        return $this->smsRepository->verifyOtp($request->phone_number, $request->otp);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status_code' => 200,
            'success' => true,
            'message' => 'Logged out successfully.',
        ], 200);
    }

    public function getStates()
    {
        return $this->apiRepository->states();
    }

    public function getPopularCities()
    {
        return $this->apiRepository->popular_cities();
    }

    public function getPlacesByCity($cityId)
    {
        try {
            // Fetch places from repository
            $places = $this->apiRepository->getPlacesByCity($cityId);

            if ($places->isEmpty()) {
                return response()->json([
                    'status_code' => 404,
                    'success' => false,
                    'message' => 'No places found for this city.'
                ], 404);
            }

            return response()->json([
                'status_code' => 200,
                'success' => true,
                'data' => $places,
                'message' => 'Places listed successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function recommendedHotels()
    {
        return $this->apiRepository->getrecommendedHotels();
    }

    public function fetchRooms(Request $request)
    {
        $guestLimit = $request->input('guest_limit', 1);
        $roomCount = $request->input('room_limit', 1);
        $city = $request->input('city', null);
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $search = $request->input('search');
        $search_places = $request->input('search_places');


        // Validate guestLimit and roomCount
        $guestLimit = is_numeric($guestLimit) && $guestLimit > 0 ? (int)$guestLimit : 1;
        $roomCount = is_numeric($roomCount) && $roomCount > 0 ? (int)$roomCount : 1;

        // Build the query for hotel rooms
        $roomsQuery = HotelRooms::query()
            ->where('guest_limit', '>=', $guestLimit)
            ->where('status', 0);

        $roomsQuery->whereHas('hotel', function ($query) use ($city,$roomCount,$search,$search_places) {
            if ($city) {
                $query->where('city', $city);
            }
            $query->whereRaw('avaialable_room_count != booked_count');

            if ($search) {
                $searchWords = explode(' ', $search);
                $query->where(function ($q) use ($searchWords) {
                    foreach ($searchWords as $word) {
                        $q->orWhereRaw("LOWER(TRIM(address)) LIKE ?", ['%' . strtolower(trim($word)) . '%'])
                          ->orWhereRaw("LOWER(TRIM(place)) LIKE ?", ['%' . strtolower(trim($word)) . '%']);
                    }
                });
            }

            if ($search_places) {
                $query->where(function ($query) use ($search_places) {
                    $query->Where('place', 'like', "%$search_places%");
                });
            }
        });

        if ($start_date && $end_date) {
            $startDate = Carbon::createFromFormat('d-m-Y', $start_date)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d-m-Y', $end_date)->format('Y-m-d');
            $roomsQuery->whereDoesntHave('bookings', function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate]);
                });
            });
        }

        $rooms = $roomsQuery->get();

        $rooms = $roomsQuery->with([
            'hotel:id,name,image,policies,address,city,avaialable_room_count,rating'
        ])
        ->get()
        ->map(function ($room) {
            return [
                'room_id' => $room->id,
                'description' => $room->description,
                'amenities' => $room->aminities, // Fixed typo from 'aminities' to 'amenities'
                'price' => $room->price,
                'room_images' => $room->room_images,
                'hotel_name' => $room->hotel->name,
                'hotel_image' => $room->hotel->image,
                'hotel_policies' => $room->hotel->policies,
                'hotel_address' => $room->hotel->address,
                'hotel_rating' => $room->hotel->rating,

            ];
        });
        if ($rooms->isEmpty()) {

            return response()->json(['status_code' => 404, 'success' => false, 'message' => 'No data found.', 'rooms' => $rooms,], 404);
        }

        // Fetch the rooms with the related hotel data
        // $rooms = $roomsQuery->with('hotel:id,name,image,policies,address,city,avaialable_room_count,rating')
        //     ->get()
        //     ->map(function ($room) {
        //         return [
        //             'room_id' => $room->id,
        //             'description' => $room->description,
        //             'aminities' => $room->aminities,
        //             'price' => $room->price,
        //             'room_images' => $room->room_images,
        //             'hotel_name' => $room->hotel->name,
        //             'hotel_image' => $room->hotel->image,
        //             'hotel_policies' => $room->hotel->policies,
        //             'hotel_address' => $room->hotel->address,
        //             'hotel_rating' => $room->hotel->rating,
        //         ];
        //     });
        // $rooms['guest_count'] = $guestLimit;
        // $rooms['room_count']  = $roomCount;
        // Return hotel rooms
        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'rooms' => $rooms,
            'guest_count' => $guestLimit,
            'room_count' => $roomCount,
            'start_date' => $start_date ?? Carbon::now(),
            'end_date' => $end_date ?? Carbon::now(),
        ], 200);
    }

    public function book_room(RoomBookingRequest $request)
    {
        $validator = $request->validated();

        return $this->apiRepository->room_booking($validator);
    }

    public function bookedRooms()
    {
        return $this->apiRepository->getbooked_rooms();
    }

    public function cancelBooking($bookingId)
    {
        return $this->apiRepository->cancelBooking($bookingId);
    }

    public function cancelledRooms()
    {
        return $this->apiRepository->getcancelledRooms();
    }

    public function bussiness_contact(BussinessRegisterFormRequest $request)
    {
        $validator = $request->validated();

        return $this->apiRepository->registerBussinessCOntact($validator);
    }

    public function listProperty(BusinessPropertyRequest $request): JsonResponse
    {
        return $this->apiRepository->storeBusinessProperty($request->validated());
    }

    public function listPropertyEnquiry(Request $request): JsonResponse
    {
        return $this->apiRepository->businessPropertyEnquiry($request->validated());
    }

    public function travelAgentRegistration(AgentRegisterForm $request)
    {
        $validator = $request->validated();
        return $this->apiRepository->registerAgent($validator);
    }

    public function agentSignIn(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        return $this->apiRepository->loginAgent($validated);
    }

    public function registerWithReferral(RefferelRegisterFormRequest $request): JsonResponse
    {
        $data = $request->validated();

        return $this->apiRepository->registerWithReferral($data);
    }

    public function referralDetails($user_id)
    {
          return $this->apiRepository->getReferralDetails($user_id);
    }
}
