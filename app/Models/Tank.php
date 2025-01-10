<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_id',
        'balance',
        'branch_id',
        'user_id',
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function branch(){
        return $this->belongsTo('App\Models\Branch');
    }
    public function pumps(){
        return $this->hasMany('App\Models\Pump');
    }
    public function tank_readings(){
        return $this->hasMany('App\Models\TankReading');
    }
    public function increaseBalance($qty){
        $new_balance = $this->balance + $qty;
        $this->balance = $new_balance;
        $this->save();
        return;
    }
    public function reduceBalance($qty){
        $new_balance = $this->balance - $qty;
        $this->balance = $new_balance;
        $this->save();
        return;
    }
    public function saveReading($qty,$total_amount,$created_at){
        //old balance new balance amount 
        $opening_dip = $this->balance;
        $closing_dip = $this->balance - $qty;
        $tank_reading = TankReading::create([
            'tank_id' => $this->id,
            'op_dip_reading' => $opening_dip,
            'cl_dip_reading' => $closing_dip,
            'total_sales_amount' => $total_amount,
            'total_sales_qty' => $qty,
            'user_id' => auth()->user()->parent_id,
        ]);
        $tank_reading->created_at = $created_at;
        $tank_reading->save();
        return;
    }
    public function getFirstTankReading($_date){
        $tank_reading = TankReading::whereDate('created_at','>=',$_date)
        ->whereDate('created_at','<=',$_date)->where('tank_id',$this->id)
        ->orderBy('op_dip_reading', 'ASC')->first();
        return $tank_reading;
    }
    public function getLastTankReading($_date){
        $tank_reading = TankReading::whereDate('created_at','>=',$_date)
        ->whereDate('created_at','<=',$_date)->where('tank_id',$this->id)
        ->orderBy('cl_dip_reading', 'DESC')->first();
        return $tank_reading;
    }
}
