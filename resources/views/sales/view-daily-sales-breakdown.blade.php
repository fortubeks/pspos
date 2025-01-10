@extends('layouts.user_type.auth')

@section('content')

  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    @foreach($tanks as $tank)
                    <div class="col-md-12 mt-4">
                        <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">{{$tank->name}}</h6>
                            <h6 class="mb-3 text-sm">Opening Dip Reading: {{$tank->getFirstTankReading($_date)->op_dip_reading ?? 'None'}} - Closing Dip Reading: {{$tank->getLastTankReading($_date)->cl_dip_reading ?? 'None'}}</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                @foreach($sales as $sale)
                                @if($sale->pump->tank->id == $tank->id)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">{{$sale->pump->name}}</h6>
                                    <span class="mb-2 text-xs">Opening Meter Reading: <span class="text-dark font-weight-bold ms-sm-2">{{$sale->op_me_reading}}</span></span>
                                    <span class="mb-2 text-xs">Closing Meter Reading: <span class="text-dark ms-sm-2 font-weight-bold">{{$sale->cl_me_reading}}</span></span>
                                    <span class="mb-2 text-xs">Quantity (Litres): <span class="text-dark ms-sm-2 font-weight-bold">{{$sale->qty}}</span></span>
                                    </div>
                                    <div class="ms-auto text-end">
                                    {{Helper::formatCurrency($sale->total_amount)}}
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        </div>
                    </div>
                    @endforeach
                    <hr class="horizontal dark my-3">
                    <h5 style="text-align:right" class="mb-0 text-success">+ {{Helper::formatCurrency($total_sales_amount)}}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
                <div class="row">
                <div class="col-md-6">
                    <h6 class="mb-0">POS</h6>
                </div>
                <div class="col-md-6">
                    <h5 style="text-align:right" class="mb-0">- {{Helper::formatCurrency($total_pos_sales_amount)}}</h5>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-0">Your Expenses</h6>
              </div>
              <div class="col-md-6 d-flex justify-content-end align-items-center">
                <h5 style="text-align:right" class="mb-0 text-danger">- {{Helper::formatCurrency($total_expenses_amount)}}</h5>
              </div>
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
                @foreach($expenses as $expense)
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm">{{$expense->description}}</h6>
                    </div>
                    </div>
                    <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                    - {{Helper::formatCurrency($expense->amount)}}
                    </div>
                </li>
                @endforeach
            </ul>            
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-4">
        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-0">Banking</h6>
              </div>
              <div class="col-md-6 d-flex justify-content-end align-items-center">
                <h5 style="text-align:right" class="mb-0">- {{Helper::formatCurrency($total_bankings_amount)}}</h5>
              </div>
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
                @foreach($banking_records as $banking_record)
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm">{{$banking_record->bank_account->name}}</h6>
                    </div>
                    </div>
                    <div class="d-flex align-items-center text-gradient text-sm font-weight-bold">
                    - {{Helper::formatCurrency($banking_record->amount)}}
                    </div>
                </li>
                @endforeach
            </ul>            
          </div>
        </div>
      </div>
      <div class="col-md mt-4">
        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-0">Your Transaction's</h6>
              </div>
              <div class="col-md-6 d-flex justify-content-end align-items-center">
                <i class="far fa-calendar-alt me-2"></i>
                <small></small>
              </div>
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Today's Balance</h6>
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Today</h6>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  + {{Helper::formatCurrency($cash_at_hand_today)}}
                </div>
              </li>
              
            </ul>
            <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Yesterday</h6>
                  </div>
                </div>
                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                  + {{Helper::formatCurrency($cash_at_hand_yesterday)}}
                </div>
              </li>
            </ul>
            <hr class="horizontal dark my-3">
            <h5 style="text-align:right" class="mb-0">{{Helper::formatCurrency($cash_at_hand)}}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
 
@endsection

