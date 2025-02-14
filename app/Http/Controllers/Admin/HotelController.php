<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRegisterFormRequest;
use App\Http\Requests\UpdateHotelFormRequest;
use App\Models\Hotel;
use App\Models\PopularCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::paginate(10);

        return view('hotel.index',compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $popularCities = PopularCity::all();

        return view('hotel.create',compact('popularCities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRegisterFormRequest $request)
    {
        $validator = $request->validated();
        //dd($validator);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hotels', 'public');
            $validator['image'] = $path;
        }

        $validator['policies'] = json_encode($validator['policies']);

        $hotel = Hotel::create($validator);

        return redirect()->route('hotel.index')->with('Data Saved Successfully');
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
    public function edit(Hotel $hotel)
    {
       $popularCities = PopularCity::all();
       return view('hotel.edit',compact('popularCities','hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelFormRequest $request, Hotel $hotel)
    {
        $validator = $request->validated();

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('hotels', 'public');

            if ($hotel->image && Storage::disk('public')->exists($hotel->image)) {
                Storage::disk('public')->delete($hotel->image);
            }

            $validator['image'] = $path;
        }
       
        if (isset($validator['policies']) && is_array($validator['policies'])) {
            dd('hello');

            $validator['policies'] = json_encode($validator['policies']);
        }

        $hotel->update($validator);

        return redirect()->route('hotel.index')->with('Hotel details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotel.index')->with('Data deleted successfully');
    }
}
