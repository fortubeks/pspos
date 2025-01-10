<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use Illuminate\Http\Request;

class AttendantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendants = Attendant::all();
        return view('attendants/index')->with('attendants',$attendants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendants/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Attendant::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'other_details' => $request->other_details,
            'user_id' => auth()->user()->parent_id,
            'branch_id' => auth()->user()->branch_id
        ]);
        return redirect('/attendants/create')->with('success','Attendant added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendant  $attendant
     * @return \Illuminate\Http\Response
     */
    public function show(Attendant $attendant)
    {
        return view('attendants.show')->with('attendant',$attendant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendant  $attendant
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendant $attendant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendant  $attendant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendant $attendant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendant  $attendant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendant $attendant)
    {
        //
    }
}
