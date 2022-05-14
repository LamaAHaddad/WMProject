<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    
    public function invoice(){
        return $this->hasMany(Invoice::class,'user_id','id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id','id');
    }
    public function car(){
        return $this->hasMany(Car::class,'user_id','id');
    }
    public function product(){
        return $this->hasMany(Product::class,'user_id','id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
