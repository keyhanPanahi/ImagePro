@extends('admin.layouts.master')

@section('title','مدیریت - مجوزهای دسترسی')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <!-- select2-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/select2/select2.css') }}">
@endsection

@section('content')
    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">فهرست مجوزهای دسترسی</li>
        </ol>
    </nav>
    <form action="{{ route('admin.membership.permission.destroy') }}" method="post" id="form">
        @csrf
        {{-- delete - filterGroup - create --}}
        <div class="d-flex justify-content-between bd-highlight">
            <div class="p-2 bd-highlight">
                <a class="dt-button add-new btn btn-primary text-white" href="{{ route('admin.membership.permission.create') }}"><span><i class="bx bx-plus me-0"></i>ایجاد</span></a>
            </div>
            <div class="p-2 bd-highlight col-4">
                <select class="select-permission-group" id="permission_filter" data-column="2" data-allow-clear="true">
                    <option value=""></option>
                    @foreach ($permissionGroups as $group)
                        <option value="{{$group->title}}">{{ $group->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2 bd-highlight">
                <button type="button" class="btn btn-label-danger delete-confirm float-end ms-2"  data-bs-toggle="tooltip"  data-bs-placement="top" data-color="danger" title="حذف"><i class="tf-icons bx bx-trash"></i></button>
            </div>
        </div>
        {{-- table --}}
        <div class="card mt-3">
            <div class="card-datatable table-responsive">
                <table class=" table table-hover border-top dataTable no-footer dtr-column collapsed text-center" id="getPermissions">
                    <thead>
                    <tr>
                        <th>نام</th>
                        <th>کد یکتا 🔑</th>
                        <th>گروه</th>
                        <th>عملیات</th>
                        <th><input class="form-check-input" type="checkbox" value="" id="checkAll" data-bs-toggle="tooltip"  data-bs-placement="top" data-color="secondary" title="انتخاب همه"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </form>
@endsection

@section('vendor-js')
    <script src="{{ asset('admin-assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <!-- select2-->
    <script src="{{ asset('admin-assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/select2/i18n/fa.js') }}"></script>
@endsection

@section('page-js')
    {{-- select 2 --}}
    <script>
        $(function() {
            const select2 = $('.select-permission-group');
            // Default
            if (select2.length) {
                select2.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        // placeholder: 'انتخاب',
                        placeholder: "فیلتر بر اساس گروه",
                        dropdownParent: $this.parent()
                    });
                });
            }
        });
    </script>
    {{-- table --}}
    <script>
        $(function () {
            var table = $('#getPermissions').DataTable({
                "oLanguage": {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json"
                },
                "aoColumnDefs": [
                    {"orderable": false, "aTargets": [4]}
                ],
                pageLength: 10,
                processing: true,
                serverSide: true,
                responsive: false,
                ajax: "{{ route('admin.membership.permission.index') }}",
                columns: [
                    { data: 'title', name: 'title'},
                    { data: 'name', name: 'name'},
                    { data: 'parent', name: 'parent'},
                    { data: 'action', name: 'action'},
                    { data: 'select', name: 'select'},
                ],
            });
            //filter role select option
            $('#permission_filter').change(function(){
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
