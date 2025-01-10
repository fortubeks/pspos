<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    public function tanks(){
        return $this->hasMany('App\Models\Tank');
    }
    public function products(){
        return $this->belongsToMany('App\Models\Product')->withPivot('price', 'cost');
    }
    public function employees(){
        return $this->hasMany('App\Models\Employee');
    }
}
