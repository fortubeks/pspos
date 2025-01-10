@extends('layouts.user_type.auth')

@section('content')
<style>
    .card{
        margin-bottom: 10px;
    }
</style>
<div>
    <div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">{{ __('Select Date') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="{{url('/sales')}}" method="POST" role="form text-left">
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
                            <input value="{{date('Y-m-d')}}" name="created_at" class="flatpickr flatpickr-input form-control" type="text" placeholder="Select Date" required>
                                    @error('created_at')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach(Helper::getModelList('tanks') as $tank)
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0 text-danger">{{ __('Tank Name: '.$tank->name. ' Balance: '.$tank->balance) }}</h6>
            </div>
            @foreach($tank->pumps as $pump)
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0 text-success">{{ __('Pump / Nozzle Name: '.$pump->name) }}</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Quantity Sold (in litres/kg)') }}</label>
                                    <div class="@error('qty')border border-danger rounded-3 @enderror">
                                        <input class="form-control" onkeyup="qtyChange(this)" value="0" data-id="{{$pump->id}}" type="number" inputmode="decimal" min="0" step="any" placeholder="Quantity" name="qty[]" required>
                                            @error('qty')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Discount (if any)') }}</label>
                                    <div class="@error('discount_amount')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="0" type="number" placeholder="Discount amount" name="discount_amount[]">
                                            @error('discount_amount')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Note') }}</label>
                                    <div class="@error('note')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Note" name="note[]">
                                            @error('note')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Attendant') }}</label>
                                    <div class="@error('attendant')border border-danger rounded-3 @enderror">
                                        <select class="form-select form-control" name="attendant[]">
                                            @foreach(Helper::getModelList('attendants') as $attendant)
                                            <option value="{{$attendant->id}}">{{$attendant->getFullName()}}</option>
                                            @endforeach
                                        </select>
                                            @error('attendant')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Cash') }}</label>
                                    <div class="@error('discount_amount')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="0" type="number" placeholder="Cash amount" name="cash_amount[]">
                                            @error('discount_amount')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('POS') }}</label>
                                    <div class="@error('discount_amount')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="0" type="number" placeholder="POS amount" name="pos_amount[]">
                                            @error('discount_amount')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Others') }}</label>
                                    <div class="@error('discount_amount')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="0" type="number" placeholder="Other amount" name="other_amount[]">
                                            @error('discount_amount')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Opening Meter Reading') }}</label>
                                    <div class="@error('discount_amount')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{$pump->lastMeterReading()}}" id="op_me_reading_{{$pump->id}}" type="number" readonly type="number" inputmode="decimal" min="0" step="any" name="op_me_reading[]">
                                            @error('discount_amount')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Closing Meter Reading') }}</label>
                                    <div class="@error('discount_amount')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{$pump->lastMeterReading()}}" id="cl_me_reading_{{$pump->id}}" type="number" type="number" inputmode="decimal" min="0" step="any" readonly name="cl_me_reading[]">
                                            @error('discount_amount')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Total') }}</label>
                                    <div class="@error('total_amount')border border-danger rounded-3 @enderror">
                                        <input class="form-control total-amount" value="0" id="total_amount_input_{{$pump->id}}" type="number" name="total_amount[]" readonly>
                                            @error('total_amount')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                        </div>
                        <input type="hidden" name="pump[]" id="pump_price_{{$pump->id}}" value="{{$pump->id}}" data-price="{{$pump->tank->product->branch_product()->pivot->price}}">

                    </div>
                </div>
            @endforeach 
        </div>
        @endforeach
         
        <div class="card-footer">
            <div class="form-group">
                <label for="about">{{ 'Grand Total For The Day' }}</label>
                <div class="@error('total_amount')border border-danger rounded-3 @enderror">
                    <input class="form-control" type="text" id="grand_total"  readonly>
                </div>
            </div>
            <div class="d-flex justify-content-end">
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
    maxDate: "today",
    allowInput: true
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
round_figure = Math.round (amount / 10) * 10
document.getElementById(total_amount_input).value = round_figure;
//end of amount change
//begin closing meter change
cl_me_reading_input = 'cl_me_reading_'+id;
op_me_reading_input = 'op_me_reading_'+id;
new_cl_me_reading = parseFloat(document.getElementById(op_me_reading_input).value) + parseFloat(qty);
document.getElementById(cl_me_reading_input).value = new_cl_me_reading;
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

    $('input').click(function() {
    this.select();
});

});

</script>