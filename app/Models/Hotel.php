<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'address',
        'place',
        'city',
        'state',
        'default_facilities',
        'policies',
        'avaialable_room_count',
        'booked_count',
        'rating',
        'image'
    ];

    public function hotelRooms()
    {
        return $this->hasMany(HotelRooms::class,'hotel_id');
    }

    
}
