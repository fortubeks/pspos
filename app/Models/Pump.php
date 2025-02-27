<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pump extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'tank_id',
        'user_id',
    ];

    public function tank()
    {
        return $this->belongsTo('App\Models\Tank');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }

    public function lastMeterReading()
    {
        //get last sale on the pump and get cl_me_reading
        $last_sale = Sale::orderBy('created_at', 'desc')->where('pump_id', $this->id)->first();
        if ($last_sale) {
            return $last_sale->cl_me_reading;
        }
        return 0.00;
    }
}
