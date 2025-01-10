<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'tank_id',
        'product_id',
        'cost',
        'qty',
        'amount',
        'user_id',
        'expense_id',
        'branch_id'
    ];
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
