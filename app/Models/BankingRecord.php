<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'bank_account_id',
        'note',
        'user_id',
        'branch_id'
    ];

    public function bank_account(){
        return $this->belongsTo('App\Models\BankAccount');
    }
}
