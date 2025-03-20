<?php

namespace App\Http\Controllers;

use App\Models\Pump;
use Illuminate\Http\Request;

class PumpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pumps = collect();
        $tanks = auth()->user()->branch->tanks;
        foreach ($tanks as $tank) {
            foreach ($tank->pumps as $pump) {
                $pumps->add($pump);
            }
        }
        return view('pumps.index')->with('pumps', $pumps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pumps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pump = Pump::create([
            'name' => $request->name,
            'tank_id' => $request->tank,
            'product_id' => $request->product,
            'user_id' => auth()->user()->parent_id,
        ]);
        return redirect('/pumps')->with('success', 'Pump was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function show(Pump $pump)
    {
        return view('pumps.show')->with('pump', $pump);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function edit(Pump $pump)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pump $pump)
    {
        $pump->update($request->all());
        return redirect('/pumps')->with('success', 'Pump was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pump $pump)
    {
        //
    }
}
