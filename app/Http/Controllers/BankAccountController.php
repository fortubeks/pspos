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
        return view('bank-accounts.index')->with('bank_accounts', $bank_accounts);
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'balance' => 'nullable|numeric|min:0',
        ]);

        $bank_account = BankAccount::create([
            'name' => $validatedData['name'],
            'number' => $validatedData['number'],
            'bank_name' => $validatedData['bank_name'],
            'balance' => $validatedData['balance'] ?? 0,
            'other_details' => $validatedData['bank_name'],
            'user_id' => auth()->user()->parent_id,
        ]);
        return redirect('/bank-accounts')->with('success', 'Bank Account was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bank_accounts
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bank_account)
    {
        return view('bank-accounts.show')->with('bank_account', $bank_account);
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
