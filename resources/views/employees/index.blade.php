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
                                        Active
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
                                        <p class="text-xs font-weight-bold mb-0">{{$employee->user ? $employee->user->getActiveStatus() : 'No'}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$employee->created_at->format('d-M-Y')}}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('employees/'.$employee->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit employee">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a class="mx-3 delete-employee" href="javascript:void(0);" data-employee-id="{{$employee->id}}" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" title="Delete Employee">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
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
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteBarOrderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCartModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this employee?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form method="POST" id="employee-form" action="{{ url('employees/') }}">
                    @csrf @method('delete')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    window.addEventListener('load', function() {

        $(".delete-employee").click(function(event) {
            var employeeId = $(this).data('employee-id');
            var currentUrl = "{{ url('employees') }}";

            // Construct the new URL with appended bar order ID
            var newUrl = currentUrl + "/" + employeeId;

            // Update the form action attribute with the new URL
            $("#employee-form").attr("action", newUrl);

        });
    });
</script>