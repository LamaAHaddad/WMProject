<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function cars(){
        return $this->belongsToMany(Car::class,'product_id','id');
    }
    public function categries(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function invoices(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}
