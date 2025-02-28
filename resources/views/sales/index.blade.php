@extends('layouts.user_type.auth')

@section('content')
<style>
  .table td {
    padding: 1.5rem;
  }

  td p {
    text-align: right;
  }
</style>
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">

      <div class="col-3">
        <div class="form-group">
          <form action="" method="get">
            <label for="user-name" class="form-control-label">{{ __('From Date') }}</label>
            <input name="date_from" value="{{$date_from}}" class="flatpickr flatpickr-input form-control" type="text" placeholder="Select Date" required>
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label for="user-name" class="form-control-label">{{ __('To Date') }}</label>
          <input name="date_to" value="{{$date_to}}" class="flatpickr flatpickr-input form-control" type="text" placeholder="Select Date" required>
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Filter</button>
          </form>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
              <div>
                <h5 class="mb-0">Sales</h5>
              </div>
              <a href="{{url('/pos')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Sales</a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date/Time</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KG</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Price</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Amount</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Method</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bank</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($sales as $sale)
                  <tr>
                    <td>
                      <h6 class="mb-0 text-sm">{{$sale->created_at->format('d-m-y h:i')}}</h6>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">{{$sale->qty}} KG</p>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">{{formatCurrency($sale->unit_price)}}</p>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">{{formatCurrency($sale->total_amount)}}</p>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">{{$sale->payment_method}}</p>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">{{$sale->bankAccount->name}}</p>
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0">
                        <i class="fa fa-ellipsis-v text-xs"></i>
                      </button>
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
</main>

<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-" style="max-width: 90%;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification"></h6>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="sales_container" class="py-3 text-center">
          <i class="ni ni-bell-55 ni-3x"></i>
          <h4 class="text-gradient text-danger mt-4"></h4>
          <p></p>
        </div>
      </div>
      <div class="modal-footer">
        <button id="btn-view-more" data-date="" type="button" class="btn btn-white btn-view-more">View More Details</button>
        <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
  .modal-dialog {
    max-width: 100%;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  window.addEventListener('load', function() {
    flatpickr('.flatpickr', {
      maxDate: "today"
    });

    flatpickr('.range', {
      mode: "range"
    });
    flatpickr('.datetimepicker', {
      enableTime: true,
      dateFormat: "Y-m-d H:i",
    });

    $('table .show-report').click(function() {
      var date = $(this).attr("data-date");
      if (date) {
        $('#modal-title-notification').html('Sales for ' + date);
        $('#btn-view-more').attr('data-date', date);
        url = "{{ url('/ajax/get-sales-summary/') }}/" + date;
        $.get(url, function(data, status) {
          console.log(data);
          let html = '<table class="table"><thead><tr><th class="text-center">Details</th><th></th><th></th>';
          html += '</tr></thead><tbody>';
          for (i = 0; i < data.length; i++) {
            html += '<tr><td style="background-color:bisque" class="text-center font-weight-bold">Pump Name =====  ' + data[i].pump.name + '</td>';
            html += '<td class="text-center">Opening Meter Reading =====  ' + data[i].op_me_reading + '</td>';
            html += '<td  class="text-center">Closing Meter Reading =====  ' + data[i].cl_me_reading + '</td></tr>';
            html += '<tr><td class="text-center">Total Sales (L) =====  ' + data[i].qty + '</td>';
            html += '<td></td><td class="text-center">Total Amount (NGN) =====  ' + data[i].total_amount + '</td>';
            html += '</tr><tr><td></td></tr>';
          }
          html += '</tbody></table>';
          $('#sales_container').html(html);
        });
      }
    });
    $('.btn-view-more').click(function() {
      var date = $(this).attr("data-date");
      var url = "{{url('view-daily-sales-breakdown')}}/" + date;
      if (url) {
        window.location = url;
      }
    });
  })
</script>