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
              <table id="sales-table" class="table align-items-center justify-content-center mb-0">
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
                      @if($user->user_type == 'SUPER_ADMIN' || $user->user_type == 'MANAGER')
                      <a class="mx-3 delete-sale" href="javascript:void(0);" data-sale-id="{{$sale->id}}" data-bs-toggle="modal" data-bs-target="#deleteOrderModal" title="Delete Sale">
                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                      </a>
                      @endif
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
<div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteBarOrderModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCartModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this sale?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method="POST" id="sale-form" action="{{ url('sales/') }}">
          @csrf @method('delete')
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
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

    var sales_table = $('#sales-table').DataTable({
      lengthChange: false,
      buttons: [{
          extend: 'excel',
          title: 'Sales Dotafex'
        },
        {
          extend: 'pdf',
          title: 'Sales Dotafex'
        },
        {
          extend: 'print',
          title: 'Sales Dotafex',
          customize: function(win) {
            $(win.document.body)
              .css('font-size', '10pt')
              .prepend('<p style="text-align: left;">Total Sales:{{formatCurrency($totalSalesAmount)}}</p><p style="text-align: left;">Total KG:{{$totalKg}}</p><p style="text-align: left;">Date:{{$date_from." to ".$date_to}}</p>'); // Add title to the print view
          }
        }
      ],
      "order": [
        [0, "desc"]
      ],
    });

    sales_table.buttons().container().appendTo('#sales-table_wrapper .col-md-6:eq(0)');

    $(".delete-sale").click(function(event) {
      var saleId = $(this).data('sale-id');
      var currentUrl = "{{ url('sales') }}";

      // Construct the new URL with appended bar order ID
      var newUrl = currentUrl + "/" + saleId;
      // Update the form action attribute with the new URL
      $("#sale-form").attr("action", newUrl);

    });

  });
</script>