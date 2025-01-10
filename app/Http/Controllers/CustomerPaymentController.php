<?php

namespace App\Http\Controllers;

use App\Models\CustomerPayment;
use Illuminate\Http\Request;

class CustomerPaymentController extends Controller
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
        $payment = CustomerPayment::create([
            'customer_id' => $request->customer_id,
            'bank_account_id' => $request->bank_account_id,
            'mode_of_payment' => $request->mode_of_payment,
            'notes' => $request->note,
            'amount' => $request->payment_amount,
        ]);
        $payment->created_at = $request->p_created_at;
        $payment->save();
        return redirect('customers/'.$request->customer_id)->with('success','Payment added succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerPayment  $customerPayment
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerPayment  $customerPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerPayment  $customerPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerPayment $customerPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerPayment  $customerPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerPayment $customerPayment)
    {
        //
    }
}
