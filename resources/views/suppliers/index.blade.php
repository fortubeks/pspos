@extends('layouts.user_type.auth')

@section('content')

<div>
    

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="mb-0">All Suppliers</h5>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="{{url('/suppliers/create')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Supplier</a>
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
                                        Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Supplied
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Payments
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Balance (Owing)
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($suppliers as $supplier)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$supplier->name}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$supplier->getTotalSupplied()}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{Helper::formatCurrency($supplier->getTotalPayments())}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{Helper::formatCurrency($supplier->getBalanceOwing())}}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('suppliers/'.$supplier->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit employee">
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