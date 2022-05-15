<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $hidden = ['updated_at'];

    protected $casts = [
        'active' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:ia'
    ];

    public function stores()
    {
        return $this->hasMany(Store::class, 'city_id', 'id');
    }
    public function stocks(){
        return $this->hasMany(Stock::class,'city_id','id');
    }
    public function getActiveStatusAttribute(){
        return $this->active ? 'Active' : ' InActive';
    }
}
