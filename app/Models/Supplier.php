<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'contact_person_name',
        'contact_person_phone',
        'bank_account_name',
        'bank_name',
        'bank_sort_code',
        'bank_account_no',
        'email',
    ];
    public function payments(){
        return $this->hasMany('App\Models\SupplierPayment');
    }
    public function supplies(){
        return $this->hasMany('App\Models\Expense');
    }
    public function getTotalSupplied(){
        return 0;
    }
    public function getTotalPayments(){
        return 0;
    }
    public function getBalanceOwing(){
        return 0;
    }
}
