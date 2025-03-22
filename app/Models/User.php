<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'employee_id',
        'user_type',
        'parent_id',
        'branch_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function bankAccounts()
    {
        return $this->hasMany('App\Models\BankAccount');
    }

    public function branches()
    {
        return $this->hasMany('App\Models\Branch');
    }

    public function expenseCategories()
    {
        return $this->hasMany('App\Models\ExpenseCategory');
    }

    public function suppliers()
    {
        return $this->hasMany('App\Models\Supplier');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\User', 'parent_id');
    }
}
