<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function store(){
        return $this->hasMany(Store::class,'city_id','id');
    }
    public function stock(){
        return $this->hasMany(Stock::class,'city_id','id');
    }
    public function getActiveStatusAttribute(){
        return $this->active ? 'Active' : ' InActive';
    }
}
