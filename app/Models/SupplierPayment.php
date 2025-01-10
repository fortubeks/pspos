<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_id',
        'mode_of_payment',
        'supplier_id',
        'amount',
        'note',
    ];
}
