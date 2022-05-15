<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function getTotalAttribute() {
        return $this->quantity * $this->price;
    }

    public function getActiveStatusAttribute(){
        return $this->active ? 'Active' : ' InActive';
    }

    public function products(){
        return $this->hasMany(Product::class,'invoice_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id','id');
    }


}
