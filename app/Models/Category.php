<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }

    public function getActiveStatusAttribute(){
        return $this->active ? 'Active' : ' InActive';
    }
}
