<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        "name",
        "status",
        "species",
        "type",
        "gender",
        "image",
        "origin_location_id"
    ];

    public function originLocation()
    {
        return $this->belongsTo(Location::class);
    }
}
