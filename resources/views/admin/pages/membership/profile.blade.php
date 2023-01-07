@extends('admin.layouts.master')

@section('title','پروفایل')

@section('page-css')
    <!-- profile-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/pages/page-profile.css') }}">
@endsection

@section('content')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="breadcrumb-item active" aria-current="page">پروفایل</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                <img src="{{ asset('admin-assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    @php
                        $defaultAvatar = auth()->user()->sex_id == 1 ? env('AVATAR_WOMAN') : env('AVATAR_MAN');
                    @endphp
                    <img src="{{ asset(auth()->user()->avatar ? env('AVATAR_PATH').auth()->user()->avatar : $defaultAvatar) }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded-3 user-profile-img"> 
                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                    <div class="user-profile-info">
                        <h4>{{ auth()->user()->fullName }}</h4>
                        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                            @if ($user->roles->count() > 0)
                            <li class="list-inline-item fw-semibold"><i class="bx bx-shield"></i> نقش : 
                                @foreach (auth()->user()->roles as $role)
                                    <span class="badge bg-label-dark me-2">{{ $role->title }}</span>
                                @endforeach
                            </li>
                            @endif
                        </ul>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- User Information -->
        <div class="col-xl-4 col-lg-7 col-md-7">
            <b class="badge bg-label-primary mb-2"> <i class="bx bx-info-circle"></i> اطلاعات </b>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="my-2">
                        @if ($user->roles->count() > 0)
                            <div class="d-flex align-items-center me-4 mt-2 gap-3">
                                <span class="badge bg-label-primary p-2 rounded mt-0"><i class="bx bx-check-shield bx-sm"></i></span>
                                <div>
                                    <span>نقش</span>
                                    <h5 >
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-label-dark">{{$role->title}}</span>
                                        @endforeach
                                    </h5>

                                </div>
                            </div>
                        @endif
                        @if ($user->organization)
                            <div class="d-flex align-items-center me-4 mt-2 gap-3">
                                <span class="badge bg-label-primary p-2 rounded mt-0"><i class="bx bx-building bx-sm"></i></span>
                                <div class="mt-2">
                                    <span>سازمان</span>
                                    <h6>{{ $user->organization->name ?? ''}}</h6>
                                </div>
                            </div>
                        @endif
                    </div>
                    <h5 class="pb-2 border-bottom mb-2 secondary-font">جزئیات</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">نام و نام خانوادگی:</span>
                                <span>{{ $user->full_name }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">ایمیل:</span>
                                <span>{{ $user->email ?? '-' }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">شماره همراه:</span>
                                <span>{{ $user->mobile ?? '-' }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">آدرس:</span>
                                <span>{{ $user->address ?? '-' }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">وضعیت:</span>
                                <span class="btn badge bg-label-{{ $user->status == 1 ? 'success' : 'danger'}}">
                                    {{ $user->status == 1 ? 'فعال' : 'غیرفعال'}}
                                </span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">شماره نظام پزشکی:</span>
                                <span>{{ $user->medical_code ?? '-' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Account -->
        <div class="col-xl-4 col-lg-5 col-md-5">
            <b class="badge bg-label-primary mb-2"> <i class="bx bx-user"></i> حساب کاربری </b>
            <div class="card mb-4">
                <div class="card-body border-bottom ">
                    <form action="{{ route('admin.membership.profile.changeAvatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="d-flex align-items-start align-items-sm-center mb-3">
                            <img src="{{ asset(auth()->user()->avatar ? env('AVATAR_PATH').auth()->user()->avatar : $defaultAvatar) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-sm btn-outline-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">بارگزاری تصویر</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" name="avatar" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg">
                                </label>
                                <button type="button" class="btn btn-sm btn-label-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">بازنشانی</span>
                                </button>
                            </div>
                        </div>
                        <div class="mb-1">
                            @error('avatar')
                            <span class="text-danger"> * {{ $message }}</span>
                            @enderror
                        </div> 
                        <div class="row mt-3">
                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                                <button class="btn btn-primary" type="submit">ذخیره تصویر</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.membership.profile.changeProfileInformation') }}" method="post">
                        @csrf
                        @method('PUT')
                        <ul class="list-unstyled mb-3 mt-2">
                            <label for="first_name" class="mt-2"><span class="fw-semibold mx-2">نام :</span></label>
                            <li class="d-flex align-items-center my-3">
                                <div class="input-group">
                                    <span class="input-group-text" ><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}" placeholder="نام کاربری خود را وارد کنید" >
                                </div>
                            </li>
                            <div class="mb-2">
                                @error('first_name')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>

                            <label for="last_name" class="mt-2"><span class="fw-semibold mx-2">نام خانوادگی:</span></label>
                            <li class="d-flex align-items-center my-3">
                                <div class="input-group">
                                    <span class="input-group-text" ><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" placeholder="نام کاربری خود را وارد کنید" >
                                </div>
                            </li>
                            <div class="mb-2">
                                @error('last_name')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>

                            <label for="email" class="mt-2"><span class="fw-semibold mx-2">پست الکترونیکی:</span></label>
                            <li class="d-flex align-items-center my-3">
                                <div class="input-group">
                                    <span class="input-group-text" ><i class="bx bx-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="پست الکترونیک خود را وارد کنید">
                                </div>
                            </li>
                            <div class="mb-2">
                                @error('email')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </ul>
                        <div class="row mt-2">
                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                                <button class="btn btn-primary" type="submit">ذخیره تغییرات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- User Password -->
        <div class="col-xl-4 col-lg-7 col-md-7">
            <!-- Change Password -->
            <b class="badge bg-label-primary mb-2"> <i class="bx bx-lock"></i> تغییر رمز عبور </b>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user-password.update') }}" method="POST">
                        @csrf
                        @method('put')
                        <ul class="list-unstyled">

                            <label for="current_password" class="mt-2"><span class="fw-semibold mx-2">رمز عبور فعلی :</span></label>
                            <li class="d-flex align-items-center my-2">
                                <div class="input-group">
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="current_password" class="form-control text-start" id="current_password" placeholder="············" >
                                    </div>
                                </div>
                            </li>
                            <div class="mb-1">
                                @error('current_password','updatePassword')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>

                            <label for="password" class="mt-2"><span class="fw-semibold mx-2">رمز عبور جدید :</span></label>
                            <li class="d-flex align-items-center my-2">
                                <div class="input-group">
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" class="form-control text-start"  id="password" placeholder="············" >
                                    </div>
                                </div>
                            </li>
                            <div class="mb-1">
                                @error('password','updatePassword')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>

                            <label for="password_confirmation" class="mt-2"><span class="fw-semibold mx-2">تکرار رمز عبور جدید :</span></label>
                            <li class="d-flex align-items-center my-2">
                                <div class="input-group">
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password_confirmation" class="form-control text-start"  id="password_confirmation" placeholder="············" >
                                    </div>
                                </div>
                            </li>
                            <div class="mb-1">
                                @error('password_confirmation','updatePassword')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>

                        </ul>
                        <div class="row mt-2">
                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                                <button class="btn btn-primary" type="submit">تغییر رمز عبور</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-4">
            <div class="card">
                <form action="{{ route('') }}"></form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="ms-3 mt-2">تغییر آواتار</h5>
                <form action="{{ route('admin.membership.profile.changeAvatar') }}" method="POST">
                    @csrf
                    <div class="text-center">
                        <img src="{{ asset(auth()->user()->avatar ? env('AVATAR_PATH').auth()->user()->avatar : $defaultAvatar) }}"  alt="user-avatar" class="d-block mx-auto mb-3 rounded-3" width="120" height="120" id="uploadedAvatar">
                        <label for="upload" class="btn btn-sm btn-primary ms-2" tabindex="0">
                            <span class="d-none d-sm-block">بارگذاری تصویر</span><i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" name="avatar" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg">
                        </label>
                        <button type="button" class="btn btn-sm btn-label-secondary account-image-reset"><i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">بازنشانی</span>
                        </button>
                    </div>

                    <button type="submit" class="btn btn-label-success float-end my-3 me-2">ذخیره</button>
                </form>
            </div>
        </div>
    </div> --}}
@endsection

@section('page-js')
    <!-- Avatar -->
    <script>  
        document.addEventListener('DOMContentLoaded', function (e) {
            (function () { 
                // Update/reset user image of account page
                let accountUserImage = document.getElementById('uploadedAvatar');
                const fileInput = document.querySelector('.account-file-input'),
                resetFileInput = document.querySelector('.account-image-reset');
            
                if (accountUserImage) {
                const resetImage = accountUserImage.src;
                fileInput.onchange = () => {
                    if (fileInput.files[0]) {
                    accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                    }
                };
                resetFileInput.onclick = () => {
                    fileInput.value = '';
                    accountUserImage.src = resetImage;
                };
                }
            })();
        }); 
    </script> 
@endsection