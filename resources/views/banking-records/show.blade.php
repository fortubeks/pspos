@extends('layouts.user_type.auth')

@section('content')

<div>
    
    <div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">{{ __('Expense') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="{{url('/expenses/'.$expense->id)}}" method="POST" role="form text-left">
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
                            <input name="created_at" class="flatpickr flatpickr-input form-control" type="text" value="{{$expense->created_at}}" required>
                                    @error('created_at')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Description') }}</label>
                            <div class="@error('qty')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" value="{{$expense->description}}" name="description">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Category') }}</label>
                            <div class="@error('product')border border-danger rounded-3 @enderror">
                                <select id="category" class="form-select form-control" data-category="{{$expense->category_id}}" name="category">
                                    @foreach(Helper::getModelList('expense-categories') as $expense_category)
                                    <option value="{{$expense_category->id}}">{{$expense_category->name}}</option>
                                    @endforeach
                                </select>
                                    @error('product')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Amount') }}</label>
                            <div class="@error('qty')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="number" value="{{$expense->amount}}" name="amount">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <div class="card-footer">
            
            <div class="d-flex justify-content-end">
                @method('put')
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
    var category = $('#category').attr("data-category");
    $('#category option[value='+category+']').attr('selected','selected');
});
</script>
<script>
window.addEventListener('load', function() {

    $('input').click(function() {
    this.select();
});

});

</script>