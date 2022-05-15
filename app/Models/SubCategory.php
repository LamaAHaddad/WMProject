<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public function categories(){
        return $this->hasMany(Category::class,'subcategory_id','id');
    }

    public function getActiveStatusAttribute(){
        return $this->active ? 'Active' : ' InActive';
    }
}
