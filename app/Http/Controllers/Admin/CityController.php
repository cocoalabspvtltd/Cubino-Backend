<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopularCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = PopularCity::all();
        return view('city.index', compact('cities'));
    }

    /**
     * Create a newly data.
     */

    public function create()
    {
       return view('city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cities', 'public');
            $validator['image'] = $path;
        }

        PopularCity::create($validator);

        return redirect()->route('cities.index')->with('Data Saved Successfully');
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
    public function edit(PopularCity $city)
    {
        return view('city.edit', compact('city'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PopularCity $city)
    {
        $validator = $request->all();

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('cities', 'public');

            if ($city->image && Storage::disk('public')->exists($city->image)) {
                Storage::disk('public')->delete($city->image);
            }

            $validator['image'] = $path;
        }

        $city->update($validator);

        return redirect()->route('cities.index')->with('Data updated successfully.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
