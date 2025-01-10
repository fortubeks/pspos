<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'bank_account_id',
        'mode_of_payment',
        'notes',
        'amount',
    ];
}
