<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'qty',
        'unit_price',
        'total_amount',
        'op_me_reading',
        'cl_me_reading',
        'pump_id',
        'attendant_id',
        'note',
        'user_id',
        'branch_id',
        'bank_account_id',
        'payment_method',
    ];
    public function pump()
    {
        return $this->belongsTo('App\Models\Pump');
    }
    public function attendant()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
