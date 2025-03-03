<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = getModelList('employees');
        return view('employees/index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = Employee::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->employee_email,
            'other_details' => $request->other_details,
            'role_id' => $request->role_id,
            'bank_name' => $request->bank_name,
            'bank_account_no' => $request->bank_account_no,
            'bank_account_name' => $request->bank_account_name,
            'user_id' => auth()->user()->parent_id,
            'branch_id' => $request->branch_id
        ]);
        if ($request->is_user == 'yes') {
            User::create([
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'employee_id' => $employee->id,
                'user_type' => $request->user_type,
                'parent_id' => auth()->user()->parent_id,
                'branch_id' => $request->branch_id,
            ]);
        }
        return redirect('/employees/')->with('success', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        if ($request->is_user == 'yes') {
            User::updateOrcreate([
                'email'   => $request->email,
                'employee_id'   => $employee->id,
            ], [
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'employee_id' => $employee->id,
                'user_type' => $request->user_type,
                'parent_id' => auth()->user()->parent_id,
                'branch_id' => $request->branch_id,
            ]);
        }
        return redirect('/employees')->with('success', 'Update succesful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
