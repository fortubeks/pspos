<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function sales(){
        return $this->belongsTo('App\Models\Sale');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Models\Branch')->withPivot('price', 'cost');
    }
    public function branch_product(){
        $branch_product = auth()->user()->branch->products()->where('product_id',$this->id)->first();
        return $branch_product;
    }
    public function getTotalSalesByPeriod($from,$to){
        $total_sales = DB::table('sales')->join('products', 'products.id', '=', 'sales.product_id')
        ->where('sales.product_id','=',$this->id)
        ->where('sales.branch_id','=',auth()->user()->branch_id)
        ->whereDate('sales.created_at','>=',$from)
        ->whereDate('sales.created_at','<=',$to)
        ->select('sales.total_amount')->distinct()->sum('sales.total_amount');
        return $total_sales;
    }
    
    public function getDailySalesByPeriod($from,$to){
        
        $sales = Sale::join('products', 'products.id', '=', 'sales.product_id')
        ->where('sales.product_id','=',$this->id)
        ->where('sales.branch_id','=',auth()->user()->branch_id)
        ->whereDate('sales.created_at','>=',$from)
        ->whereDate('sales.created_at','<=',$to)
        ->get(['sales.*']);
        return $sales;
    }
}
