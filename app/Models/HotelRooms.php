<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRooms extends Model
{
    protected $fillable = [
        'hotel_id',
        'description',
        'facilities',
        'aminities',
        'price',
        'guest_limit',
        'status',
        'room_images'
    ];

    protected $casts = [
        'room_images' => 'array',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }
}
