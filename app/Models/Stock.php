<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function invoice(){
        return $this->hasMany(Invoice::class,'stock_id','id');
    }
    public function user(){
        return $this->hasMany(User::class,'stock_id','id');
    }
}
