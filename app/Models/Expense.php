<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_category_id',
        'description',
        'amount',
        'supplier_id',
        'user_id',
        'branch_id'
    ];
    public function expense_category(){
        return $this->belongsTo('App\Models\ExpenseCategory');
    }
}
