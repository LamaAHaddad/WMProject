<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function car(){
        return $this->belongsToMany(Car::class,'product_id','id');
    }
    public function categry(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id','id');
    }
}
