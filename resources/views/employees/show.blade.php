@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Employee Details') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{url('/employees/'.$employee->id)}}" method="POST" role="form text-left">
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
                                <label for="user-name" class="form-control-label">{{ __('First Name') }}</label>
                                <div class="@error('qty')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{$employee->first_name}}" type="text" placeholder="Name eg. Mary" name="first_name">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Middle Name') }}</label>
                                <div class="@error('cost')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{$employee->middle_name}}" type="text" placeholder="Middle Name" name="middle_name">
                                    @error('cost')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Last Name') }}</label>
                                <div class="@error('cost')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{$employee->last_name}}" type="text" placeholder="Last Name" name="last_name">
                                    @error('cost')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Gender') }}</label>
                                <div class="@error('price')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" data-gender="{{$employee->gender ?? 'j'}}" id="gender" name="gender">
                                        <option value="">--Select--</option>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Phone') }}</label>
                                <div class="@error('qty')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{$employee->phone}}" type="text" placeholder="Phone" name="phone">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email Address') }}</label>
                                <div class="@error('cost')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{$employee->email}}" type="email" placeholder="Email" name="employee_email">
                                    @error('cost')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Home Address') }}</label>
                                <div class="@error('cost')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" value="{{$employee->address}}" placeholder="Home Address" name="address">
                                    @error('cost')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Designation') }}</label>
                                <div class="@error('price')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" id="role" data-role="{{$employee->role_id}}" name="role_id" required>
                                        <option value="">--Select--</option>
                                        <option value="2">Accountant</option>
                                        <option value="3">Manager</option>
                                        <option value="4">Pump Attendant</option>
                                        <option value="5">Others</option>
                                    </select>
                                    @error('price')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Branch') }}</label>
                                <div class="@error('product')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" id="branch" data-branch="{{$employee->last_name}}" name="branch_id">
                                        @foreach(getModelList('branches') as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Other Details') }}</label>
                                <div class="@error('cost')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" value="{{$employee->other_details}}" name="other_details">
                                    @error('cost')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Bank Account Details') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Bank') }}</label>
                            <div class="@error('product')border border-danger rounded-3 @enderror">
                                <select class="form-select form-control" id="bank" data-bank="{{$employee->bank_name ?? 'b'}}" name="bank_name">
                                    <option value="">--Select--</option>
                                    @foreach(getBanksList() as $bank)
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
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" value="{{$employee->bank_account_no}}" placeholder="Account number" name="bank_account_no">
                                @error('cost')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Account Name') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" value="{{$employee->bank_account_name}}" placeholder="Name on account" name="bank_account_name">
                                @error('cost')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('User') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Is A User') }}</label>
                            <div class="form-check form-switch">

                                <input class="form-check-input" type="checkbox" @if($employee->user) {{__('checked')}} @endif value="yes" name="is_user" id="is_user" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Is Active') }}</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" @if($employee->user->is_active == 1) {{__('checked')}} @endif value="yes" name="is_active" id="is_active" >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 user-hide">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Role') }}</label>
                            <div class="@error('product')border border-danger rounded-3 @enderror">
                                <select class="form-select form-control" id="user_type" data-user-type="{{$employee->user->user_type ?? 'u'}}" name="user_type">
                                    <option value="">--Select--</option>
                                    <option value="MANAGER">Manager</option>
                                    <option value="ATTENDANT">Pump Attendant</option>
                                </select>
                                @error('product')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 user-hide">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="text" value="{{$employee->user->email ?? ''}}" placeholder="Login Email" name="email">
                                @error('cost')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 user-hide">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Password') }}</label>
                            <div class="@error('cost')border border-danger rounded-3 @enderror">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                                @error('cost')
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
@if(!$employee->user)
<style>
    .user-hide {
        display: none;
    }
</style>
@endif
<script>
    window.addEventListener('load', function() {

        $('#is_user').change(function() {
            if (this.checked) {
                $('.user-hide').css('display', 'block');
            } else {
                $('.user-hide').css('display', 'none');
            }
        });
        var role = $('#role').attr("data-role");
        $('#role option[value=' + role + ']').attr('selected', 'selected');
        var branch = $('#branch').attr("data-branch");
        $('#branch option[value=' + branch + ']').attr('selected', 'selected');
        var gender = $('#gender').attr("data-gender");
        $('#gender option[value=' + gender + ']').attr('selected', 'selected');
        var bank = $('#bank').attr("data-bank");
        $('#bank option[value=' + bank + ']').attr('selected', 'selected');
        var user_type = $('#user_type').attr("data-user-type");
        $('#user_type option[value=' + user_type + ']').attr('selected', 'selected');
    });
</script>