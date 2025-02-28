@extends('layouts.user_type.auth')

@section('content')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="mb-0">All Employees</h5>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Payroll</a>
                                <a href="{{url('/employees/create')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Employee</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Designation
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Branch
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Employee since
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td>
                                        <div>
                                            <img src="{{url('/assets/')}}/img/team-2.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$employee->getFullName()}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$employee->getDesignation()}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$employee->phone}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{getModel('branches',$employee->branch_id)->name}}</p>
                                    </td>
                                    <td>
                                        <p class="text-secondary text-xs font-weight-bold">{{$employee->created_at->format('d-M-Y')}}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('employees/'.$employee->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit employee">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection