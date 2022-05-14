<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    // public function products(){
    //     return $this->belongsToMany(Product::class,'car_id','id');
    // }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function getActiveStatusAttribute(){
        return $this->active ? 'Active' : ' InActive';
    }
}
