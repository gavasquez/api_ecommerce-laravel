<?php

namespace App\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use HasFactory;
    use SoftDeletes; // soft delete
    protected $fillable = [
        "name",
        "icon",
        "imagen",
        "categorie_second_id",
        "categorie_third_id",
        "position",
        "type_categorie",
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

    public function categori_second(){
        return $this->belongsTo(Categorie::class, "categorie_second_id");
    }

    public function categori_third(){
        return $this->belongsTo(Categorie::class, "categorie_third_id");
    }


}
