<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use App\Models\BankAccount;
use App\Models\BankingRecord;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Pump;
use App\Models\Sale;
use App\Models\Tank;
use App\Models\TankReading;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date_from = today();
        $date_to = now();
        $user = auth()->user();

        if ($request->has('date_from')) {
            $date_from = $request->date_from;
            $date_to = $request->date_to;
        }
        $query = Sale::whereDate('sales.created_at', '>=', $date_from)
            ->whereDate('sales.created_at', '<=', $date_to)
            ->where('branch_id', auth()->user()->branch_id)
            ->with('pump', 'bankAccount');
        $sales = $query->get();
        $totalSalesAmount = $query->sum('total_amount');
        $totalKg = $query->sum('qty');
        return view('sales.index')->with(compact('sales', 'date_from', 'date_to', 'user', 'totalSalesAmount', 'totalKg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    public function pos()
    {
        return view('sales.pos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'qty' => 'required',
            'op_me_reading' => 'required',
            'cl_me_reading' => 'required',
            'pump' => 'required',
            'bank_account' => 'required',
            'created_at' => 'required'
        ]);
        try {
            $pump = Pump::find($request->pump)->first();
            $unit_price = $pump->product->branch_product()->pivot->price;
            $total_amount =  $request->qty * $unit_price;

            DB::beginTransaction();

            $sale = Sale::create([
                'product_id' => $pump->product->id,
                'qty' => $request->qty,
                'unit_price' => $unit_price,
                'total_amount' => $total_amount,
                'pump_id' => $pump->id,
                'op_me_reading' => $request->op_me_reading,
                'cl_me_reading' => $request->cl_me_reading,
                'attendant_id' => auth()->user()->id,
                'user_id' => auth()->user()->parent_id,
                'branch_id' => auth()->user()->branch_id,
                'bank_account_id' => $request->bank_account,
                'payment_method' => $request->mode_of_payment,
            ]);
            $date = new Carbon($request->created_at);
            $date->setTimeFromTimeString(now()->toTimeString());
            $sale->created_at = $date;
            $sale->save();
            //reduce value in tank
            $tank = Tank::find($pump->tank->id);
            //$tank->saveReading($request->qty, $request->total_amount, $request->created_at);
            $tank->reduceBalance($request->qty);

            //update bank account balance
            $bank_account = BankAccount::find($request->bank_account);
            $bank_account->balance = $bank_account->balance + $request->total_amount;
            $bank_account->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            return redirect('/pos')->withErrors(['error' => 'An error occurred while adding the sale: ' . $e->getMessage()]);
        }

        return redirect('print-sale/' . $sale->id)->with('success', 'Sales was added successfully');
    }

    public function printSale($id)
    {
        $sale = Sale::findOrFail($id);
        return view('printer.sales')->with('sale', $sale);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('sales.show')->with('sale', $sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //return kg to tank
        //add to closing meter reading of the last sale
        //delete sale
        try {
            DB::beginTransaction();
            $tank = Tank::find($sale->pump->tank->id);
            $tank->increaseBalance($sale->qty);
            $sale->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            return redirect('/sales')->withErrors(['error' => 'An error occurred while deleting the sale: ' . $e->getMessage()]);
        }
        return redirect('/sales')->with('success', 'Sale was deleted successfully');
    }

    public function getSupermarketSales($date_from, $date_to)
    {
        $sales = 0;
        $sqlQueryResult = DB::connection('mysql2')->select('SELECT sum(grand_total) as grand_total FROM sales 
        where created_at >= ? AND created_at <= ?', [$date_from, $date_to]);
        foreach ($sqlQueryResult as $result) {
            $sales =  $result->grand_total;
        }
        return $sales;
    }

    public function getDailySupermarketSales($date_from, $date_to)
    {
        $sales = collect();
        $sqlQueryResult = DB::connection('mysql2')->select('SELECT grand_total,created_at FROM sales 
        where created_at >= ? AND created_at <= ?', [$date_from, $date_to]);
        foreach ($sqlQueryResult as $result) {
            $sale = new Sale([
                'total_amount' => $result->grand_total,
                'created_at' => $result->created_at
            ]);
            $sales->push($sale);
        }
        return $sales;
    }

    public function getGrandTotalSales($supermarket_sales, $date_from, $date_to)
    {

        $total_product_sales = Sale::whereDate('sales.created_at', '>=', $date_from)
            ->whereDate('sales.created_at', '<=', $date_to)
            ->where('branch_id', auth()->user()->branch_id)
            ->sum('total_amount');
        return $total_product_sales + $supermarket_sales;
    }

    public function getSalesSummary(Request $request)
    {
        $date = new Carbon($request->date);

        $total_product_sales = Sale::whereDate('sales.created_at', '>=', $date)
            ->where('branch_id', auth()->user()->branch_id)
            ->whereDate('sales.created_at', '<=', $date)->with('pump.tank')
            ->get();
        return $total_product_sales;
    }

    public function getCashAtHandFromPreviousDay($date)
    {
        $_date = new Carbon($date);
        $prev_date = $_date->subDay();
        $total_sales_amount = Sale::whereDate('sales.created_at', '>=', $prev_date)
            ->where('branch_id', auth()->user()->branch_id)
            ->whereDate('sales.created_at', '<=', $prev_date)
            ->sum('total_amount');
        $total_pos_sales_amount = Sale::whereDate('sales.created_at', '>=', $prev_date)
            ->where('branch_id', auth()->user()->branch_id)
            ->whereDate('sales.created_at', '<=', $prev_date)
            ->sum('pos_amount');
        $total_expenses_amount = Expense::whereDate('created_at', '>=', $prev_date)
            ->where('branch_id', auth()->user()->branch_id)
            ->whereDate('created_at', '<=', $prev_date)->sum('amount');
        $bankings = '';
        $cash_at_hand = $total_sales_amount - $total_pos_sales_amount - $total_expenses_amount;
        return $cash_at_hand;
    }

    public function viewDailySalesBreakdown(Request $request, $date)
    {
        $_date = new Carbon($date);

        $tanks = auth()->user()->branch->tanks;
        $sales = Sale::whereDate('sales.created_at', '>=', $_date)
            ->whereDate('sales.created_at', '<=', $_date)->with('pump.tank')
            ->where('branch_id', auth()->user()->branch_id)
            ->get(); //dd($sales);
        $total_sales_amount = Sale::whereDate('sales.created_at', '>=', $_date)
            ->whereDate('sales.created_at', '<=', $_date)
            ->where('branch_id', auth()->user()->branch_id)
            ->sum('total_amount');
        $total_pos_sales_amount = Sale::whereDate('sales.created_at', '>=', $_date)
            ->whereDate('sales.created_at', '<=', $_date)
            ->where('branch_id', auth()->user()->branch_id)
            ->sum('pos_amount');
        $expenses = Expense::whereDate('created_at', '>=', $_date)
            ->whereDate('created_at', '<=', $_date)
            ->where('branch_id', auth()->user()->branch_id)->get();
        $total_expenses_amount = Expense::whereDate('created_at', '>=', $_date)
            ->whereDate('created_at', '<=', $_date)
            ->where('branch_id', auth()->user()->branch_id)->sum('amount');
        $banking_records = BankingRecord::whereDate('created_at', '>=', $_date)
            ->whereDate('created_at', '<=', $_date)
            ->where('branch_id', auth()->user()->branch_id)->get();
        $total_bankings_amount = BankingRecord::whereDate('created_at', '>=', $_date)
            ->whereDate('created_at', '<=', $_date)
            ->where('branch_id', auth()->user()->branch_id)->sum('amount');

        $cash_at_hand_today = $total_sales_amount - $total_pos_sales_amount - $total_bankings_amount - $total_expenses_amount;
        $cash_at_hand_yesterday = $this->getCashAtHandFromPreviousDay($_date);
        $cash_at_hand = $cash_at_hand_today + $cash_at_hand_yesterday;
        //Get all sales
        //get all expenses
        //get all banking
        //get cash at hand
        //return as compact to the view
        return view('sales.view-daily-sales-breakdown')->with(compact(
            'tanks',
            'sales',
            'expenses',
            'total_sales_amount',
            'total_expenses_amount',
            'total_pos_sales_amount',
            'cash_at_hand',
            '_date',
            'cash_at_hand_today',
            'cash_at_hand_yesterday',
            'banking_records',
            'total_bankings_amount'
        ));
    }
}
