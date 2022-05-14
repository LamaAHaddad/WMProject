<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $appends = ['city_name'];

    public function getCityNameAttribute()
    {
        // return $this->city->name_en;
        return $this->city()->first()->name;
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function user(){
        return $this->hasMany(User::class,'store_id','id');
    }
    public function invoice(){
        return $this->hasMany(Invoice::class,'store_id','id');
    }
}
