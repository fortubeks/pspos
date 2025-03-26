<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'email',
        'gender',
        'address',
        'active',
        'other_details',
        'bank_name',
        'bank_account_no',
        'bank_account_name',
        'role_id',
        'branch_id',
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($employee) {
            // Delete related user
            $employee->user->delete();
        });
    }
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }
    public function getDesignation()
    {
        $designation = '';
        if ($this->role_id == 1) {
            $designation = 'Super Admin';
        }
        if ($this->role_id == 2) {
            $designation = 'Accountant';
        }
        if ($this->role_id == 3) {
            $designation = 'Branch Manager';
        }
        if ($this->role_id == 4) {
            $designation = 'Pump Attendant';
        }
        return $designation;
    }
}
