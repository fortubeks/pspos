@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card mb-3">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Customer Details') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{url('/customers')}}" method="POST" role="form text-left">
                @csrf
                @if($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
                        {{$errors->first()}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                        {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Customer Name') }}</label>
                            <div class="@error('qty')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{$customer->name}}" type="text" placeholder="Name eg. Mary or Total Co Ltd." name="name">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Phone') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{$customer->phone}}" type="text" placeholder="Phone" name="phone">
                                    @error('cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Address') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{$customer->address}}" type="text" placeholder="Address" name="address">
                                    @error('cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="company" class="form-control-label">{{ __('Company') }}</label>
                            <input type="radio" id="company" value="0" name="type" class="">
                            <label for="individual" class="form-control-label">{{ __('Individual') }}</label>
                            <input type="radio" id="individual" value="1" name="type" class="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Email') }}</label>
                            <div class="@error('qty')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{$customer->email}}" type="email" placeholder="Email" name="email">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Contact Person Name') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" value="{{$customer->contact_person_name}}" placeholder="Name" name="contact_person_name">
                                    @error('cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Contact Person Phone') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" value="{{$customer->contact_person_phone}}" placeholder="Phone" name="contact_person_phone">
                                    @error('cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    @method('put')
                    <button type="submit" class="btn bg-gradient-dark btn-md mb-0">{{ 'Save' }}</button>
                </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="mb-0">Vehicles</h6>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-row justify-content-between">
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->vehicles  as $vehicle)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$vehicle->name}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="mb-0">Sales</h6>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-row justify-content-between">
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-primary bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Vehicle
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->sales  as $sale)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$sale->created_at->format('d-M-y')}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$sale->vehicle->name ?? ''}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$sale->total_amount}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="mb-0">Payments</h6>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-row justify-content-between">
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-primary bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mode
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->payments  as $payment)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$payment->created_at->format('d-M-y')}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$payment->mode_of_payment}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$payment->amount}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <form action="{{url('vehicles')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control" name="name" placeholder="Vehicle details" required>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save' }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Sale</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <form action="{{url('customer-sales')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input value="{{date('Y-m-d')}}" name="s_created_at" class="flatpickr flatpickr-input form-control" type="text" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select form-control" name="vehicle_id">
                        <option value="">--Select Vehicle--</option>
                        @foreach($customer->vehicles ?? [] as $vehicle)
                        <option value="{{$vehicle->id}}">{{$vehicle->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="product"  class="form-select form-control" name="product_id">
                    <option value="">--Select Product--</option>
                        @foreach(Helper::getModelList('products') as $product)
                        <option data-price="{{$product->branch_product()->pivot->price}}" value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="number" placeholder="Enter Quantity" data-price="" id="qty" name="qty" class="form-control" onkeyup="qtyChange()" type="number" inputmode="decimal" min="0" step="any" required>
                </div>
                <div class="col-md-4">
                    <select class="form-select form-control" name="attendant_id">
                        <option value="">--Select Attendant--</option>
                        @foreach(Helper::getModelList('attendants') as $attendant)
                        <option value="{{$attendant->id}}">{{$attendant->getFullName()}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" placeholder="Total Amount" readonly name="sales_amount" id="sales_amount" class="form-control">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save' }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <form action="{{url('customer-payments')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input value="{{date('Y-m-d')}}" name="p_created_at" class="flatpickr flatpickr-input form-control" type="text" placeholder="Select Date" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select form-control" name="attendant_id">
                        <option value="">--Bank--</option>
                        @foreach(Helper::getModelList('bank-accounts') as $bank)
                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" placeholder="Total Amount" name="payment_amount" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select class="form-select form-control" name="mode_of_payment">
                        <option value="">--Mode of Payment--</option>
                        <option value="Transfer">Transfer</option>
                        <option value="Cash">Cash</option>
                        <option value="Pos">POS</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" placeholder="Notes" name="note" class="form-control">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save' }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    .user-hide{
        display: none;
    }
</style>
<script>
    window.addEventListener('load', function() {
        flatpickr('.flatpickr', {
            
        });
        $('#is_user').change(function () {
        if (this.checked){
            $('.user-hide').css('display','block');
        }
        else{
            $('.user-hide').css('display','none');
        }
    });
    $('#product').on('change', function(e){
    price = $(this).find("option:selected").data('price');
    $('#qty').data('price',price);
    qtyChange();
    });

    });
    function qtyChange(){
    qty = document.getElementById('qty').value;
    price = $('#qty').data('price');
    amount = qty*price;
    round_figure = Math.round (amount / 10) * 10
    document.getElementById('sales_amount').value = round_figure;
    } 
</script>

