@extends('layouts.user_type.auth')

@section('content')
<style>
    .card {
        margin-bottom: 10px;
    }
</style>
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body pt-4 p-3">
                <form method="post" action="{{ url('sales') }}">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Pump') }}</label>
                                <div class="@error('pump')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" name="pump[]" id="pump-select" onchange="updateTotalSale()">
                                        @foreach(getModelList('pumps') as $pump)
                                        <option data-price="{{$pump->tank->product->branch_product()->pivot->price}}"
                                            data-closing-reading="{{$pump->lastMeterReading()}}"
                                            value="{{$pump->id}}">{{$pump->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pump')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" id="calc-display" name="qty" class="form-control text-end mb-3" oninput="updateTotalSale()">
                    <div class="row">
                        <div class="col-md-3">
                            <h3 class="form-control-label mt-3"><i class="fa-solid fa-right-to-bracket"></i>
                                <span id="opening-reading">{{ $pump->lastMeterReading() }}</span>
                            </h3>
                        </div>
                        <div class="col-md-3">
                            <h3 class="form-control-label mt-3"><i class="fa-solid fa-right-from-bracket"></i>
                                <span id="closing-reading">{{ $pump->lastMeterReading() }}</span>
                            </h3>
                        </div>
                        <div class="col-md-6">
                            <h3 class="form-control-label mt-3">{{ __('This Sale') }}
                                <span id="total-sale">0.00</span>
                            </h3>
                            <input type="hidden" name="op_me_reading" id="op_me_reading" value="{{ $pump->lastMeterReading() }}">
                            <input type="hidden" name="cl_me_reading" id="cl_me_reading" value="{{ $pump->lastMeterReading() }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputPrice" class="form-label">Mode of Payment</label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="mode_of_payment" id="paymentCash" value="cash" required>
                                    <label class="form-check-label" for="paymentCash">Cash</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="mode_of_payment" checked id="paymentPOS" value="pos" required>
                                    <label class="form-check-label" for="paymentPOS">POS</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="mode_of_payment" id="paymentTransfer" value="transfer" required>
                                    <label class="form-check-label" for="paymentTransfer">Transfer</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="mode_of_payment" id="paymentWallet" value="wallet" required>
                                    <label class="form-check-label" for="paymentWallet">Wallet</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputPrice" class="form-label">Account</label>
                            <select class="form-select" name="bank_account" required>
                                @foreach(getModelList('bank-accounts') as $account)
                                <option value="{{$account->id}}">{{$account->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 btn-lg ">{{ 'Proceed' }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body pt-4 p-3">
                    <div class="row g-2">
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('7')">7</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('8')">8</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('9')">9</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('4')">4</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('5')">5</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('6')">6</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('1')">1</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('2')">2</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('3')">3</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('0')">0</button>
                        <button class="btn btn-secondary col-4" onclick="addToDisplay('.')">.</button>
                        <button class="btn btn-danger col-4" onclick="clearDisplay()">C</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Close out order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-primary" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#add-payment" role="tab"
                            aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                                </div>
                                <div class="tab-title">Add Payment</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade active show" id="add-payment" role="tabpanel">
                        <form method="post" action="{{ url('sales') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputPrice" class="form-label">Mode of Payment</label>
                                    <select class="form-select" name="mode_of_payment" required>
                                        <option value="">--Select--</option>
                                        <option value="cash">Cash</option>
                                        <option value="pos">POS</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="wallet">Wallet</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputPrice" class="form-label">Account</label>
                                    <select class="form-select" name="account" required>
                                        <option value="">--Select--</option>
                                        @foreach(getModelList('bank-accounts') as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="col-12">
                                    <label for="inputCompareatprice" class="form-label">Amount Paid</label>
                                    <input type="number" class="form-control" min="0" step="any" name="payment_amount" id="amount-paid"
                                        placeholder="00.00">
                                </div> -->

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save' }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go back</button>
            </div>
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

    function qtyChange(obj) {
        qty = obj.value;
        id = obj.getAttribute('data-id');
        pump_price_input = 'pump_price_' + id;
        total_amount_input = 'total_amount_input_' + id;
        price = document.getElementById(pump_price_input).getAttribute('data-price');
        amount = qty * price;
        round_figure = Math.round(amount / 10) * 10
        document.getElementById(total_amount_input).value = round_figure;
        //end of amount change
        //begin closing meter change
        cl_me_reading_input = 'cl_me_reading_' + id;
        op_me_reading_input = 'op_me_reading_' + id;
        new_cl_me_reading = parseFloat(document.getElementById(op_me_reading_input).value) + parseFloat(qty);
        document.getElementById(cl_me_reading_input).value = new_cl_me_reading;
    }

    function discValueChange(obj) {
        disc_amount = obj.value;
        id = obj.getAttribute('data-id');
        price_input = 'price' + id;
        disc_value_input = 'discount_type' + id;
        qty_input = 'qty' + id;
        qty = document.getElementById(qty_input).value;
        discount_type = document.getElementById(disc_value_input).value;

        price = document.getElementById(price_input).getAttribute('data-price');
        amount = price * qty - disc_amount;
        document.getElementById(price_input).value = amount;

    }
</script>
<script>
    function updateTotalSale() {
        let display = document.getElementById('calc-display');
        let quantity = parseFloat(display.value) || 0;

        let selectedPump = document.getElementById('pump-select');
        let price = parseFloat(selectedPump.options[selectedPump.selectedIndex].getAttribute('data-price')) || 0;
        let openingReading = parseFloat(selectedPump.options[selectedPump.selectedIndex].getAttribute('data-closing-reading')) || 0;

        let totalSale = quantity * price;
        // Format totalSale as money (assuming NGN currency)
        let formattedTotalSale = new Intl.NumberFormat('en-NG', {
            style: 'currency',
            currency: 'NGN',
            minimumFractionDigits: 2
        }).format(totalSale);

        document.getElementById('total-sale').textContent = formattedTotalSale;

        let closingReading = openingReading + quantity;
        document.getElementById('closing-reading').textContent = closingReading.toFixed(2);
        document.getElementById('cl_me_reading').value = closingReading.toFixed(2);
    }

    function addToDisplay(value) {
        let display = document.getElementById('calc-display');
        display.value += value;
        updateTotalSale();
    }

    function clearDisplay() {
        document.getElementById('calc-display').value = '';
        updateTotalSale();
    }
</script>
<script>
    window.addEventListener('load', function() {

        $('input').click(function() {
            this.select();
        });

    });
</script>