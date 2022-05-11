<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public function cities(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function users(){
        return $this->hasMany(User::class,'store_id','id');
    }
    public function invoices(){
        return $this->hasMany(Invoice::class,'store_id','id');
    }
}
