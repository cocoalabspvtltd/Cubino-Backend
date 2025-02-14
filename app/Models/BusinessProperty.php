<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessProperty extends Model
{
    protected $guarded = [];

    protected $casts = [
        'address' => 'array',
        'property_information' => 'array',
        'facilities' => 'array',
        'property_images' => 'array',
    ];
}
