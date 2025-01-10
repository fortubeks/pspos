<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank_accounts = BankAccount::all();
        return view('bank-accounts.index')->with('bank_accounts',$bank_accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bank-accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank_accounts = BankAccount::create([
            'name' => $request->name,
            'number' => $request->number,
            'bank_name' => $request->bank_name,
            'other_details' => $request->bank_name,
            'user_id' => auth()->user()->parent_id,
        ]);
        return redirect('/bank-accounts/create')->with('success','Bank Account was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bank_accounts
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bank_account)
    {
        return view('bank-accounts.show')->with('bank_account',$bank_account);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bank_accounts
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bank_accounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bank_accounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bank_accounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bank_accounts
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bank_accounts)
    {
        //
    }
}
