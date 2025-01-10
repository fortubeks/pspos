<?php

namespace App\Http\Controllers;

use App\Models\BankingRecord;
use Illuminate\Http\Request;

class BankingRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banking_records = BankingRecord::all();
        return view('banking-records.index')->with('banking_records',$banking_records);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banking-records.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banking_record = BankingRecord::create([
            'bank_account_id' => $request->bank_account,
            'amount' => $request->amount,
            'note' => $request->note,
            'user_id' => auth()->user()->parent_id,
            'branch_id' => auth()->user()->branch_id
        ]);
        $banking_record->created_at = $request->created_at;
        $banking_record->save();
        return redirect('/banking-records/create')->with('success','Banking Record was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankingRecord  $banking_records
     * @return \Illuminate\Http\Response
     */
    public function show(BankingRecord $banking_record)
    {
        return view('banking-records.show')->with('banking_record',$banking_record);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankingRecord  $banking_records
     * @return \Illuminate\Http\Response
     */
    public function edit(BankingRecord $banking_records)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankingRecord  $banking_records
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankingRecord $banking_records)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankingRecord  $banking_records
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankingRecord $banking_records)
    {
        //
    }
}
