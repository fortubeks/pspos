<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tank;

class TankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanks = auth()->user()->branch->tanks;
        return view('tanks.index')->with('tanks',$tanks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tanks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanks = Tank::create([
            'name' => $request->name,
            'product_id' => $request->product,
            'balance' => $request->balance,
            'user_id' => auth()->user()->parent_id,
            'branch_id' => auth()->user()->branch_id
        ]);
        return redirect('/tanks')->with('success','Tank was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tank  $tanks
     * @return \Illuminate\Http\Response
     */
    public function show(Tank $tank)
    {
        return view('tanks.show')->with('tank',$tank);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tank  $tanks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tank $tanks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tank  $tanks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tank $tanks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tank  $tanks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tank $tanks)
    {
        //
    }
}
