<?php

use App\Models\Product;
use App\Models\Attendant;
use App\Models\Tank;
use App\Models\ExpenseCategory;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Magarrent\LaravelCurrencyFormatter\Facades\Currency;

function formatCurrency($amount)
{
    $f = (float)$amount;
    return Currency::currency("NGN")->format($f);
}
function getModelList($model)
{
    $model_list = null;
    if ($model == 'products') {
        $model_list = auth()->user()->branch->products;
    }
    if ($model == 'employees') {
        $model_list = auth()->user()->branch->employees;
    }
    if ($model == 'attendants') {
        $model_list = auth()->user()->branch->employees()->where('role_id', 4)->get();
    }
    if ($model == 'pumps') {
        $pumps = collect();
        $tanks = auth()->user()->branch->tanks;
        foreach ($tanks as $tank) {
            foreach ($tank->pumps as $pump) {
                $pumps->add($pump);
            }
        }
        return $pumps;
    }
    if ($model == 'tanks') {
        $model_list = auth()->user()->branch->tanks;
    }
    if ($model == 'expense-categories') {
        $model_list = auth()->user()->parent->expenseCategories;
    }
    if ($model == 'bank-accounts') {
        $model_list = auth()->user()->parent->bankAccounts;
    }
    if ($model == 'branches') {
        $model_list = auth()->user()->parent->branches;
    }
    if ($model == 'suppliers') {
        $model_list = auth()->user()->parent->suppliers;
    }
    return $model_list;
}
function getModel($_model, $id)
{
    $model = null;
    if ($_model == 'products') {
        $model = Product::find($id);
    }
    if ($_model == 'attendants') {
        $model = Attendant::find($id);
    }
    if ($_model == 'tanks') {
        $model = Tank::find($id);
    }
    if ($_model == 'expense-categories') {
        $model = ExpenseCategory::find($id);
    }
    if ($_model == 'bank-accounts') {
        $model = BankAccount::find($id);
    }
    if ($_model == 'branches') {
        $model = Branch::find($id);
    }
    return $model;
}
function branch()
{
    return auth()->user()->branch;
}
function calculateTaxAmount($amount)
{
    $activeTaxes = getActiveTaxes();
    $totalTaxAmount = 0;

    // Apply each tax to the amount
    foreach ($activeTaxes as $tax) {
        // Calculate tax amount for the current tax
        $taxAmount = ($tax->rate / 100) * $amount;

        // Add to the total tax amount
        $totalTaxAmount += $taxAmount;
    }

    return $totalTaxAmount;
}

function getActiveTaxes()
{
    // Fetch all active taxes from the database
    return DB::table('taxes')->select('rate')->where('active', 1)->get();
}
function getBanksList()
{
    $banks = [
        'Access Bank Plc',
        'Fidelity Bank Plc',
        'First City Monument Bank Plc',
        'First Bank of Nigeria Limited',
        'Guaranty Trust Bank Plc',
        'Union Bank of Nigeria Plc',
        'United Bank for Africa Plc',
        'Zenith Bank Plc',
        'Citibank Nigeria Limited',
        'Ecobank Nigeria Plc',
        'Heritage Banking Company Limited',
        'Keystone Bank Limited',
        'Polaris Bank Limited. (Formerly Skye Bank Plc)',
        'Stanbic IBTC Bank Plc',
        'Standard Chartered',
        'Sterling Bank Plc',
        'Titan Trust Bank Limited',
        'Unity Bank Plc',
        'Wema Bank Plc',
        'Globus Bank Limited',
        'SunTrust Bank Nigeria Limited',
        'Providus Bank Limited',
        'Jaiz Bank Plc',
        'Taj Bank Limited',
        'Coronation Merchant Bank',
        'FBNQuest Merchant Bank',
        'FSDH Merchant Bank',
        'Rand Merchant Bank',
        'Nova Merchant Bank',
        'Opay',
        'Kuda Bank',
        'Moniepoint',
        'VFD Microfinance Bank',
    ];
    sort($banks);
    return $banks;
}
function getDashboardSales($product_id)
{
    $product = Product::find($product_id);
    return formatCurrency($product->getTotalSalesByPeriod(now(), now()));
}
