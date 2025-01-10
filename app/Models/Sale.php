<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'discount_amount',
        'qty',
        'total_amount',
        'pos_amount',
        'cash_amount',
        'others_amount',
        'op_me_reading',
        'cl_me_reading',
        'pump_id',
        'attendant_id',
        'note',
        'user_id',
        'branch_id'
    ];
    public function pump(){
        return $this->belongsTo('App\Models\Pump');
    }
    public function attendant(){
        return $this->belongsTo('App\Models\Attendant');
    }
}
