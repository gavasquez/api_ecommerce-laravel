<?php

namespace App\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product\Propertie;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes; // soft delete
    protected $fillable = [
        "name",
        "type_attribute",
        "state",
    ];

    public function setCreatedAtAttribute($value){
        date_default_timezone_set("America/Bogota"); // set timezone
        $this->attributes["created_at"] = Carbon::now();
    }

    public function setUpdatedAtAttribute($value){
        date_default_timezone_set("America/Bogota"); // set timezone
        $this->attributes["updated_at"] = Carbon::now();
    }

    public function properties(){
        return $this->hasMany(Propertie::class);
    }
}
