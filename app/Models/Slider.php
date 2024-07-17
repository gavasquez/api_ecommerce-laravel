<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes; // soft delete
    protected $fillable = [
        "title",
        "subtitle",
        "imagen",
        "label",
        "link",
        "state",
        "color",
    ];

    public function setCreatedAtAttribute($value){
        date_default_timezone_set("America/Bogota"); // set timezone
        $this->attributes["created_at"] = Carbon::now();
    }

    public function setUpdatedAtAttribute($value){
        date_default_timezone_set("America/Bogota"); // set timezone
        $this->attributes["updated_at"] = Carbon::now();
    }
}
