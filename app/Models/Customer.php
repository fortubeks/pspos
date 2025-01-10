<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'contact_person_name',
        'contact_person_phone',
        'email',
        'address',
        'phone',
    ];
    public function vehicles(){
        return $this->hasMany('App\Models\Vehicle');
    }
    public function sales(){
        return $this->hasMany('App\Models\CustomerSale');
    }
    public function payments(){
        return $this->hasMany('App\Models\CustomerPayment');
    }
}
