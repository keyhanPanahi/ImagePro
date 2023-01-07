@extends('admin.layouts.master')

@section('title','فهرست کاربران')

@section('vendor-css')
    <!-- data table -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <!-- select2-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/select2/select2.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
        <li class="breadcrumb-item active">فهرست کاربران</li>
    </ol>
</nav>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="secondary-font fw-medium">مجموع مدیران</span>
                        <div class="d-flex align-items-baseline mt-2">
                            <h5 class="mb-0 me-2" id="counter" data-target="154878"></h5>
                        </div>
                    </div>
                    <span class="badge bg-label-primary rounded p-2 mt-2"><i class="bx bx-user bx-sm"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="secondary-font fw-medium">مدیران ویژه</span>
                        <div class="d-flex align-items-baseline mt-2">
                            <h5 class="mb-0 me-2" id="counter" data-target="214"></h5>
                        </div>
                    </div>
                    <span class="badge bg-label-danger rounded p-2 mt-2"><i class="bx bx-user-plus bx-sm"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="secondary-font fw-medium">مدیران فعال</span>
                        <div class="d-flex align-items-baseline mt-2">
                            <h5 class="mb-0 me-2" id="counter" data-target="110"></h5>
                        </div>
                    </div>
                    <span class="badge bg-label-success rounded p-2 mt-2"><i class="bx bx-group bx-sm"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span class="secondary-font fw-medium">مدیران در انتظار</span>
                        <div class="d-flex align-items-baseline mt-2">
                            <h5 class="mb-0 me-2" id="counter" data-target="237"></h5>
                        </div>
                    </div>
                    <span class="badge bg-label-warning rounded p-2 mt-2"><i class="bx bx-user-voice bx-sm"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('admin.membership.user.destroy') }}" method="POST" id="form">
    @csrf
    <input type="hidden" name="status" id="status">

    <div class="d-flex justify-content-between bd-highlight">
        <div class="p-2 bd-highlight">
            <a href="{{ route('admin.membership.user.create') }}" class="btn btn-primary"><i class="bx bx-user-plus"></i> ایجاد کاربر</a>
        </div>
        <div class="p-2 bd-highlight col-3"> 
                <select class="select-user-role" id="user_filter" data-column="3" data-allow-clear="true">
                    <option value=""></option>
                    @foreach ($userRole->children as $role)
                        <option value="{{$role->title}}">{{ $role->title }}</option>
                    @endforeach
                </select> 
        </div>
        <div class="p-2 bd-highlight col-3">  
                <select class="select-organization" id="organization_filter" data-column="4" data-allow-clear="true">
                    <option value=""></option>
                    @foreach ($organizations as $organization)
                        <option value="{{$organization->name}}">{{ $organization->name }}</option>
                    @endforeach
                </select> 
        </div>
        <div class="p-2 bd-highlight"> 
            <button type="button" class="btn btn-label-danger float-end delete-confirm" data-bs-toggle="tooltip"  data-bs-placement="top" data-color="danger" title="حذف"><i class="bx bx-trash"></i></button>

            <button type="button" class="btn btn-label-secondary float-end me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="تغییر وضعیت">
                <i class="bx bx-toggle-right"></i>
            </button>
            <ul class="dropdown-menu">
                <li><button type="button" class="dropdown-item" id="active" value="{{ route('admin.membership.user.status') }}">فعالسازی</button></li>
                <li><button type="button" class="dropdown-item" id="deactive" value="{{ route('admin.membership.user.status') }}">غیرفعالسازی</button></li>
            </ul>
        </div>
    </div>
 
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-hover table-striped text-center" id="myTable">
                <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>نام کاربری</th>
                        <th>نام و نام خانوادگی</th>
                        <th>نقش</th>
                        <th>سازمان</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                        <th>
                            <label class="form-check-label m-1" for="checkAll">
                                <input class="form-check-input" type="checkbox" id="checkAll" data-bs-toggle="tooltip"  data-bs-placement="top" data-color="primary" title="انتخاب همه">
                            </label>
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection

@section('vendor-js')
    <!-- data table-->
    <script src="{{ asset('admin-assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables/i18n/fa.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <!-- select2-->
    <script src="{{ asset('admin-assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/select2/i18n/fa.js') }}"></script>
@endsection

@section('page-js')
    {{-- select 2   --}}
    <script>
        $(function() {
            const select2 = $('.select-organization');
            // Default
            if (select2.length) {
                select2.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        // placeholder: 'انتخاب',
                        placeholder: "فیلتر بر اساس سازمان",
                        dropdownParent: $this.parent()
                    });
                });
            }
        });
    </script>
    <script>
        $(function() {
            const select2 = $('.select-user-role');
            // Default
            if (select2.length) {
                select2.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        // placeholder: 'انتخاب',
                        placeholder: "فیلتر بر اساس نقش",
                        dropdownParent: $this.parent()
                    });
                });
            }
        });
    </script>
    <!-- DataTable-->
    <script>
        $(function () {
            var table = $('#myTable').DataTable({
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 7 ] },
                    { "bSearchable": false, "aTargets": [ 6 ] }
                ],
                pageLength: 10,
                processing: true,
                serverSide: true,
                // responsive: true,
                ajax: '{{ route('admin.membership.user.index') }}',
                columns: [
                    { data: 'avatar', name: 'avatar'},
                    { data: 'username', name: 'username'},
                    { data: 'fullName', name: 'fullName'},
                    { data: 'role', name: 'role'},
                    { data: 'organization_id', name: 'organization_id'},
                    { data: 'status', name: 'status'},
                    { data: 'action', name: 'action'},
                    { data: 'select', name: 'select'},
                ],
            });
            //filter role select option
            $('#user_filter').change(function(){
                table.column( $(this).data('column')).search( $(this).val() ).draw();
            });
            $('#organization_filter').change(function(){
                table.column( $(this).data('column')).search( $(this).val() ).draw();
            });
        });
    </script> 
    <!-- check all-->
    <script>
        $(document).ready(function() {
            $('#checkAll').click(function(event) {
                if(this.checked) {
                    $('.checkbox').each(function() {
                        this.checked = true;
                    });
                }
                else{
                    $('.checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
@endsection
