<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TankReading extends Model
{
    use HasFactory;
    protected $fillable = [
        'tank_id',
        'op_dip_reading',
        'cl_dip_reading',
        'total_sales_amount',
        'total_sales_qty',
        'user_id',
        'created_at',
    ];
}
