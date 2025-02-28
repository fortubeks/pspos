<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Tank;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::where('branch_id', auth()->user()->branch_id)->get();
        return view('purchases/index')->with('purchases', $purchases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchases/create');
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
            'product' => 'required',
            'tank' => 'required',
            'qty' => 'required',
            'amount' => 'required',
            'supplier' => 'required',
            'created_at' => 'required',
        ]);
        $product = Product::find($request->product);
        //create an expense first
        $expense = Expense::create([
            'description' => 'Purchase of product: ' . $product->name,
            'expense_category_id' => 4,
            'amount' => $request->amount,
            'supplier_id' => $request->supplier,
            'user_id' => auth()->user()->parent_id,
            'branch_id' => auth()->user()->branch_id
        ]);
        $expense->created_at = $request->created_at;
        $expense->save();

        $purchase = Purchase::create([
            'product_id' => $request->product,
            'tank_id' => $request->tank,
            'qty' => $request->qty,
            'cost' => $product->branch_product()->pivot->price,
            'amount' => $request->amount,
            'expense_id' => $expense->id,
            'user_id' => auth()->user()->parent_id,
            'branch_id' => auth()->user()->branch_id
        ]);
        $purchase->created_at = $request->created_at;
        $purchase->save();
        //increase tank balance
        $tank = Tank::find($request->tank);
        $tank->increaseBalance($request->qty);

        return redirect('/purchases/')->with('success', 'Purchase was added successfully and tank balance increased');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('purchases.show')->with('purchase', $purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
