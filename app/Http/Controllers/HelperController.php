<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\ExpenseCategory;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Tank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Magarrent\LaravelCurrencyFormatter\Facades\Currency;

class HelperController extends Controller
{
    public static function formatCurrency($amount)
    {
        $f = (float)$amount;
        return Currency::currency("NGN")->format($f);
    }
    // public static function getModelList($model){
    //     $model_list = null;
    //     if($model == 'products'){
    //         $model_list = auth()->user()->branch->products;
    //     }
    //     if($model == 'employees'){
    //         $model_list = auth()->user()->branch->employees;
    //     }
    //     if($model == 'attendants'){
    //         $model_list = auth()->user()->branch->employees()->where('role_id',4)->get();
    //     }
    //     if($model == 'pumps'){
    //         $pumps = collect();
    //         $tanks = auth()->user()->branch->tanks;
    //         foreach($tanks as $tank){
    //             foreach($tank->pumps as $pump){
    //                 $pumps->add($pump);
    //             }
    //         }
    //         return $pumps;
    //     }
    //     if($model == 'tanks'){
    //         $model_list = auth()->user()->branch->tanks;
    //     }
    //     if($model == 'expense-categories'){
    //         $model_list = ExpenseCategory::all();
    //     }
    //     if($model == 'bank-accounts'){
    //         $model_list = BankAccount::all();
    //     }
    //     if($model == 'branches'){
    //         $model_list = Branch::all();
    //     }
    //     if($model == 'suppliers'){
    //         $model_list = Supplier::all();
    //     }
    //     return $model_list;
    // }
    // public static function getModel($_model,$id){
    //     $model = null;
    //     if($_model == 'products'){
    //         $model = Product::find($id);
    //     }
    //     if($_model == 'attendants'){
    //         $model = Attendant::find($id);
    //     }
    //     if($_model == 'tanks'){
    //         $model = Tank::find($id);
    //     }
    //     if($_model == 'expense-categories'){
    //         $model = ExpenseCategory::find($id);
    //     }
    //     if($_model == 'bank-accounts'){
    //         $model = BankAccount::find($id);
    //     }
    //     if($_model == 'branches'){
    //         $model = Branch::find($id);
    //     }
    //     return $model;
    // }
    // public static function getBanksList(){
    //     $banks = ['Access Bank Plc','Fidelity Bank Plc','First City Monument Bank Plc','First Bank of Nigeria Limited','Guaranty Trust Bank Plc','Union Bank of Nigeria Plc','United Bank for Africa Plc','Zenith Bank Plc','Citibank Nigeria Limited','Ecobank Nigeria Plc','Heritage Banking Company Limited','Keystone Bank Limited','Polaris Bank Limited. (Formerly Skye Bank Plc)','Stanbic IBTC Bank Plc',
    //     'Standard Chartered','Sterling Bank Plc','Titan Trust Bank Limited','Unity Bank Plc','Wema Bank Plc','Globus Bank Limited','SunTrust Bank Nigeria Limited','Providus Bank Limited','Jaiz Bank Plc','Taj Bank Limited','Coronation Merchant Bank','FBNQuest Merchant Bank','FSDH Merchant Bank','Rand Merchant Bank','Nova Merchant Bank'];
    //     return $banks;
    // }
    // public static function getDashboardSales(){
    //     $sale_controller = new SalesController;
    //     $product = Product::find(1);
    //     $product_ = Product::find(2);
    //     $purchases = Purchase::where('branch_id',auth()->user()->branch_id)->whereMonth('created_at',now()->month)->get(); 
    //     $supermarket_sales = $sale_controller->getSupermarketSales(now(),now());
    //     $grand_total = HelperController::formatCurrency($sale_controller->getGrandTotalSales($supermarket_sales,now(),now()));
    //     $collection = collect(['supermarket' => HelperController::formatCurrency($supermarket_sales), 
    //     'grand_total' => $grand_total, 'pms' => HelperController::formatCurrency($product->getTotalSalesByPeriod(now(),now())), 
    //     'purchases' => $purchases]);
    //     return $collection;
    // }
    public function changeBranch(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->branch_id = $request->branch_id;
        $user->save();
        return redirect('/')->with('status', 'Branch change successful');
    }
}
