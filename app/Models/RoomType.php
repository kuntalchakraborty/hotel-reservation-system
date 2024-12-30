<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $fillable = [
       'name', 'description', 'max_occupancy',
        'security', 'air_conditioned', 'free_wifi', 'parking',
        'restaurant', 'complimentary_breakfast', 'hair_dryer',
        'mini_fridge', 'room_service', 'swimming_pool'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
