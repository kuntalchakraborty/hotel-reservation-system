<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_type_id', 'room_number', 'price', 'available',
        'bed_count', 'bed_type', 'floor_number','room_status', 'available_from', 'available_until'
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
}
