<?php

namespace App\Http\Controllers;

use App\Models\CustomerSale;
use Illuminate\Http\Request;

class CustomerSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = CustomerSale::create([
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id,
            'qty' => $request->qty,
            'total_amount' => $request->sales_amount,
            'note' => '',
            'branch_id' => auth()->user()->branch_id
        ]);
        $sale->created_at = $request->s_created_at;
        return redirect('customers/'.$request->customer_id)->with('success', 'Sales added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerSale  $customerSale
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerSale $customerSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerSale  $customerSale
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerSale $customerSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerSale  $customerSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerSale $customerSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerSale  $customerSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerSale $customerSale)
    {
        //
    }
}
