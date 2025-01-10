@extends('layouts.user_type.auth')

@section('content')

<div>
    
    <div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">{{ __('Add Attendant') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="{{url('/attendants')}}" method="POST" role="form text-left">
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
                            <label for="user-name" class="form-control-label">{{ __('Name') }}</label>
                            <div class="@error('qty')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Attendnat Name eg. Mary" name="name">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Phone') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Phone" name="phone">
                                    @error('cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Gender') }}</label>
                            <div class="@error('price')border border-danger rounded-3 @enderror">
                                <select class="form-select form-control" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('price')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Address') }}</label>
                            <div class="@error('qty')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" placeholder="Address" name="address">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Other Details') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" name="other_details">
                                    @error('cost')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Active') }}</label>
                            <div class="@error('price')border border-danger rounded-3 @enderror">
                                <select class="form-select form-control" name="is_active">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('price')
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

