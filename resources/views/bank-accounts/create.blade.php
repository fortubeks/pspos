@extends('layouts.user_type.auth')

@section('content')

<div>
    
    <div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">{{ __('Add Bank Account') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="{{url('/bank-accounts')}}" method="POST" role="form text-left">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Account Name') }}</label>
                            <div class="@error('qty')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Account Name" name="name">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Bank') }}</label>
                            <div class="@error('product')border border-danger rounded-3 @enderror">
                                <select class="form-select form-control" name="bank_name">
                                    @foreach(Helper::getBanksList() as $bank)
                                    <option value="{{$bank}}">{{$bank}}</option>
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
                            <label for="user-email" class="form-control-label">{{ __('Account Number') }}</label>
                            <div class="@error('product')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Account Number" name="number">
                                    @error('product')
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
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save' }}</button>
            </div>
            </form>
        </div>  
    </div>
</div>
@endsection

