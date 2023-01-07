@extends('admin.layouts.master')

@section('title','مدیریت - ایجاد مجوز دسترسی جدید')

@section('vendor-css')
    <!-- select2-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/select2/select2.css') }}">
@endsection

@section('content')

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.membership.permission.index') }}">فهرست مجوزهای دسترسی</a></li>
            <li class="breadcrumb-item active" aria-current="page">ایجاد مجوز دسترسی جدید</li>
        </ol>
    </nav>
    {{-- formCreatePermission --}}
    <div class="card mb-1">
        <form class="card-body" action="{{ route('admin.membership.permission.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <lable class="form-label" for="title">نام</lable>
                    <input type="text" class="form-control text-start" dir="ltr" id="title" name="title" value="{{ old('title') }}" placeholder="لطفا نام را وارد کنید">
                    @error('title')
                    <div class="mb-1"><span class="error">* {{ $message }}</span></div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <lable class="form-label" for="name">کد یکتا(🔑)</lable>
                    <input type="text" class="form-control text-start" dir="ltr" id="name" name="name" value="{{ old('name') }}" placeholder="لطفا کد یکتا را وارد کنید">
                    @error('name')
                    <div class="mb-1"><span class="error">* {{ $message }}</span></div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <lable class="form-lable" for="parent_id">انتخاب گروه</lable>
                    <select class="select2" name="parent_id">
                        <option></option>
                        @foreach($groups as $group)
                            <option name="parent_id" value="{{ $group->id }}" {{ old('parent_id') == $group->id ? 'selected' : '' }}>{{ $group->title }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="mb-1"><span class="error">* {{ $message }}</span></div>
                    @enderror
                </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">ثبت</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('vendor-js')
    {{--select2--}}
    <script src="{{ asset('admin-assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/select2/i18n/fa.js') }}"></script>
@endsection

@section('page-js')
    {{-- select 2 --}}
    <script>
        $(function() {
            const select2 = $('.select2');
            // Default
            if (select2.length) {
                select2.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        // placeholder: 'انتخاب',
                        placeholder: "برای مجوز گروه انتخاب کنید",
                        dropdownParent: $this.parent()
                    });
                });
            }
        });
    </script>
@endsection
