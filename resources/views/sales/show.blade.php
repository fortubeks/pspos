@extends('layouts.user_type.auth')

@section('content')

<div>
    
    <div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">{{ __('Select Date') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="{{url('/sales/'.$sale->id)}}" method="POST" role="form text-left">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Date') }}</label>
                            <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input name="created_at" class="flatpickr flatpickr-input form-control" value="{{$sale->created_at}}" type="text" required>
                                    @error('created_at')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Pump Name: '.$sale->pump->name) }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Quantity Sold (in litres)') }}</label>
                            <div class="@error('qty')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{$sale->qty}}" onkeyup="qtyChange(this)" data-id="{{$sale->qty}}" type="number" inputmode="decimal" min="0" step="any" placeholder="Quantity" name="qty[]">
                                    @error('qty')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Discount (if any)') }}</label>
                            <div class="@error('discount_amount')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{$sale->discount_amount}}" type="number" placeholder="Discount amount" name="discount_amount">
                                    @error('discount_amount')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Total') }}</label>
                            <div class="@error('total_amount')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{$sale->total_amount}}" id="total_amount_input_{{$sale->pump->id}}" type="number" name="total_amount" readonly>
                                    @error('total_amount')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Attendant') }}</label>
                            <div class="@error('attendant')border border-danger rounded-3 @enderror">
                                <select class="form-select form-control" data-attendant="{{$sale->attendant_id}}" name="attendant">
                                    @foreach(Helper::getModelList('attendants') as $attendant)
                                    <option value="{{$attendant->id}}">{{$attendant->name}}</option>
                                    @endforeach
                                </select>
                                    @error('attendant')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Note') }}</label>
                            <div class="@error('note')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{$sale->note}}" type="text" placeholder="Note" name="note">
                                    @error('note')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="card-footer">
            <div class="form-group">
                <label for="about">{{ 'Grand Total For The Day' }}</label>
                <div class="@error('total_amount')border border-danger rounded-3 @enderror">
                    <input class="form-control" type="text" id="grand_total"  readonly>
                </div>
            </div>
            <div class="d-flex justify-content-end">
            <input type="hidden" name="pump" id="pump_price_{{$sale->pump->id}}" value="{{$sale->pump->id}}" data-price="{{$sale->pump->product->price}}">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save' }}</button>
            </div>
            </form>
        </div>  
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

})
function qtyChange(obj){
qty = obj.value;
id = obj.getAttribute('data-id');
pump_price_input = 'pump_price_'+id;
total_amount_input = 'total_amount_input_'+id;
price = document.getElementById(pump_price_input).getAttribute('data-price');
amount = qty*price;
document.getElementById(total_amount_input).value = amount;
}
function discValueChange(obj){
disc_amount = obj.value;
id = obj.getAttribute('data-id');
price_input = 'price'+id;
disc_value_input = 'discount_type'+id;
qty_input = 'qty'+id;
qty = document.getElementById(qty_input).value;
discount_type = document.getElementById(disc_value_input).value;

price = document.getElementById(price_input).getAttribute('data-price');
    amount = price*qty - disc_amount;
    document.getElementById(price_input).value = amount;

}
</script>
<script>
window.addEventListener('load', function() {

    var attendant = $('#attendant').attr("data-attendant");
    $('#attendant option[value='+attendant+']').attr('selected','selected');
});
</script>
