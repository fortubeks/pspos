<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('expenses.index')->with('expenses',$expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense = Expense::create([
            'description' => $request->description,
            'expense_category_id' => $request->category,
            'amount' => $request->amount,
            'supplier_id' => $request->supplier_id,
            'user_id' => auth()->user()->parent_id,
            'branch_id' => auth()->user()->branch_id
        ]);
        $expense->created_at = $request->created_at;
        $expense->save();
        return redirect('/expenses/')->with('success','Expense was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('expenses.show')->with('expense',$expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $expense->update($request->all());
        return redirect('/expenses')->with('success','Expense was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
