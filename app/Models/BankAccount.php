<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'bank_name',
        'number',
        'balance',
        'other_details',
        'user_id',
    ];
}
