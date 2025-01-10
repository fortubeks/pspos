<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'vehicle_id',
        'qty',
        'total_amount',
        'note',
        'branch_id'
    ];
    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }
    public function vehicle(){
        return $this->belongsTo('App\Models\Vehicle');
    }
}
