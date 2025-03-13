<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ["name", "type", "dimension"];

    public function charaters() {
        return $this->hasMany(Character::class);
    }
}
