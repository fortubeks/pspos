<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense_categories = ExpenseCategory::all();
        return view('expense-categories.index')->with('expense_categories',$expense_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense_categories = ExpenseCategory::create([
            'name' => $request->name,
            'parent_id' => $request->category,
            'user_id' => auth()->user()->parent_id,
        ]);
        return redirect('/expense-categories/create')->with('success','ExpenseCategory was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expense_categories
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expense_category)
    {
        return view('expense-categories.show')->with('expense_category',$expense_category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expense_categories
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expense_categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseCategory  $expense_categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expense_categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseCategory  $expense_categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expense_categories)
    {
        //
    }
}
