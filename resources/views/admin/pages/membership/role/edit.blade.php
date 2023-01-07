@extends('admin.layouts.master')

@section('title','مدیریت - ویرایش نقش')

@section('vendor-css')
    <!-- select2-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/select2/select2.css') }}">
@endsection


@section('content')

    {{-- breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.membership.role.index') }}">فهرست نقش ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">ویرایش نقش</li>
        </ol>
    </nav>
    {{-- form - createRole --}}
    <div class="card mb-1">
        <form class="card-body" action="{{ route('admin.membership.role.update',$role->id) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <div class="row g-3">
                <div class="col-md-6">
                    <lable class="form-label" for="title">نام</lable>
                    <input type="text" class="form-control text-start" dir="ltr" id="title" name="title" value="{{ old('title',$role->title) }}" placeholder="لطفا نام را وارد کنید">
                    @error('title')
                    <div class="mb-1"><span class="error">* {{ $message }}</span></div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <lable class="form-label" for="name">کد یکتا(🔑)</lable>
                    <input type="text" class="form-control text-start" dir="ltr" id="name" name="name" value="{{ old('name',$role->name) }}" placeholder="لطفا کد یکتا را وارد کنید">
                    @error('name')
                    <div class="mb-1"><span class="error">* {{ $message }}</span></div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <lable class="form-lable" for="parent_id">انتخاب گروه</lable>
                    <select class="select2" name="parent_id">
                        <option></option>
                        @foreach($groups as $group)
                            <option name="parent_id" value="{{ $group->id }}" {{ old('parent_id',$role->parent_id) == $group->id ? 'selected' : '' }}>{{ $group->title }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="mb-1"><span class="error">* {{ $message }}</span></div>
                    @enderror
                </div>

                <hr class="my-4 mx-n4">
                <h6 class="fw-normal">مجوزها</h6>
                <div class="row">
                    @php
                        $icons = ["primary","success","danger","warning", "info"];
                    @endphp
                    @foreach ($permissions as $permission)
                        <div class="col-lg-3">
                            <br>

                            @php ($icons = ["primary","success","danger","warning", "info"])
                            @if ($permission->parent_id == null)
                                <small class="text-light fw-semibold badge bg-label-{{$icons[1]}}">{{$permission->title}} </small>
                            @endif
                            @if (!is_null($permission->children))
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                        @foreach ($permission->children as $child)
                                            <label class="list-group-item">
                                                <input class="form-check-input me-1" type="checkbox" value="{{$child->id}}" name="permission[]"
                                                @foreach ($role->permissions as $rolePermission)
                                                    {{ $rolePermission->id == $child->id ? 'checked' : '' }}
                                                    @endforeach
                                                >
                                                {{$child->title}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endforeach
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
                        placeholder: "برای نقش گروه انتخاب کنید",
                        dropdownParent: $this.parent()
                    });
                });
            }
        });
    </script>
@endsection
