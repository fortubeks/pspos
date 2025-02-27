<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{url()->previous()}}">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            @can('create', '\App\Models\Product')
            <form id="change_branch" method="POST" action="{{url('settings-change-branch')}}" class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                @csrf
                <div style="display:block;margin-right:30px" class="form-group mb-0">
                    <select class="form-select form-control" id="select-branch" data-branch="{{auth()->user()->branch_id}}" name="branch_id">
                        <option value="">{{'Current Branch: '.auth()->user()->branch->name}}</option>
                        @foreach(getModelList('branches') as $branch)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            @endcan
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ url('/logout')}}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<script>
    window.addEventListener('load', function() {
        var branch = $('#select-branch').attr("data-branch");
        $('#select-branch').on('change', function() {
            $('#change_branch').submit();
        });
    });
</script>